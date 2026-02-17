<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FilterConfig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilterController extends Controller
{
    private const SORT_LABELS = [
        'relevance' => 'الأكثر ملاءمة',
        'price_asc' => 'الأقل سعراً',
        'price_desc' => 'الأعلى سعراً',
        'latest' => 'الأحدث',
    ];

    public function edit(): View
    {
        $productsConfig = $this->normalizeConfig(FilterConfig::getConfig('products'));
        $categoriesConfig = $this->normalizeConfig(FilterConfig::getConfig('categories'));

        return view('dashboard.filters.index', compact('productsConfig', 'categoriesConfig'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            // products
            'p_sort_enabled' => ['nullable', 'boolean'],
            'p_sort_default' => ['nullable', 'string', 'in:relevance,price_asc,price_desc,latest'],
            'p_sort_options' => ['nullable', 'array'],
            'p_sort_options.*' => ['string', 'in:relevance,price_asc,price_desc,latest'],
            'p_price_enabled' => ['nullable', 'boolean'],
            'p_price_value' => ['nullable', 'array'],
            'p_price_value.*' => ['nullable', 'string', 'max:50'],
            'p_price_label' => ['nullable', 'array'],
            'p_price_label.*' => ['nullable', 'string', 'max:120'],
            'p_price_min' => ['nullable', 'array'],
            'p_price_min.*' => ['nullable', 'numeric', 'min:0'],
            'p_price_max' => ['nullable', 'array'],
            'p_price_max.*' => ['nullable', 'numeric', 'min:0'],
            'p_search_enabled' => ['nullable', 'boolean'],
            'p_stock_enabled' => ['nullable', 'boolean'],

            // categories
            'c_sort_enabled' => ['nullable', 'boolean'],
            'c_sort_default' => ['nullable', 'string', 'in:relevance,price_asc,price_desc,latest'],
            'c_sort_options' => ['nullable', 'array'],
            'c_sort_options.*' => ['string', 'in:relevance,price_asc,price_desc,latest'],
            'c_price_enabled' => ['nullable', 'boolean'],
            'c_price_value' => ['nullable', 'array'],
            'c_price_value.*' => ['nullable', 'string', 'max:50'],
            'c_price_label' => ['nullable', 'array'],
            'c_price_label.*' => ['nullable', 'string', 'max:120'],
            'c_price_min' => ['nullable', 'array'],
            'c_price_min.*' => ['nullable', 'numeric', 'min:0'],
            'c_price_max' => ['nullable', 'array'],
            'c_price_max.*' => ['nullable', 'numeric', 'min:0'],
            'c_search_enabled' => ['nullable', 'boolean'],
            'c_stock_enabled' => ['nullable', 'boolean'],
        ]);

        FilterConfig::setConfig('products', $this->buildConfig(
            $request,
            prefix: 'p_'
        ));

        FilterConfig::setConfig('categories', $this->buildConfig(
            $request,
            prefix: 'c_'
        ));

        return back()->with('status', 'تم حفظ إعدادات الفلاتر.');
    }

    private function normalizeConfig(array $raw): array
    {
        $defaultPriceOptions = [
            ['value' => 'under-100', 'label' => 'أقل من ١٠٠ ر.س', 'min' => null, 'max' => 99.99],
            ['value' => '100-300', 'label' => '١٠٠ - ٣٠٠ ر.س', 'min' => 100, 'max' => 300],
            ['value' => '300-500', 'label' => '٣٠٠ - ٥٠٠ ر.س', 'min' => 300, 'max' => 500],
            ['value' => 'over-500', 'label' => 'أكثر من ٥٠٠ ر.س', 'min' => 500, 'max' => null],
        ];

        $sortEnabled = (bool) data_get($raw, 'sort.enabled', true);
        $sortDefault = (string) data_get($raw, 'sort.default', 'relevance');
        $sortOptions = (array) data_get($raw, 'sort.options', array_keys(self::SORT_LABELS));
        $sortOptions = array_values(array_intersect($sortOptions, array_keys(self::SORT_LABELS)));
        if (!count($sortOptions)) {
            $sortOptions = array_keys(self::SORT_LABELS);
        }
        if (!in_array($sortDefault, $sortOptions, true)) {
            $sortDefault = $sortOptions[0] ?? 'relevance';
        }

        $priceEnabled = (bool) data_get($raw, 'price.enabled', true);
        $priceRaw = (array) data_get($raw, 'price.options', $defaultPriceOptions);
        $priceOptions = [];
        foreach ($priceRaw as $opt) {
            $value = (string) data_get($opt, 'value');
            $label = (string) data_get($opt, 'label');
            if ($value === '' || $label === '') {
                continue;
            }
            $priceOptions[] = [
                'value' => $value,
                'label' => $label,
                'min' => data_get($opt, 'min'),
                'max' => data_get($opt, 'max'),
            ];
        }
        if (!count($priceOptions)) {
            $priceOptions = $defaultPriceOptions;
        }

        $searchEnabled = (bool) data_get($raw, 'search.enabled', true);
        $stockEnabled = (bool) data_get($raw, 'stock.enabled', true);

        return [
            'sort' => [
                'enabled' => $sortEnabled,
                'default' => $sortDefault,
                'options' => $sortOptions,
            ],
            'price' => [
                'enabled' => $priceEnabled,
                'options' => $priceOptions,
            ],
            'search' => [
                'enabled' => $searchEnabled,
            ],
            'stock' => [
                'enabled' => $stockEnabled,
            ],
        ];
    }

    private function buildConfig(Request $request, string $prefix): array
    {
        $sortOptions = (array) $request->input($prefix . 'sort_options', array_keys(self::SORT_LABELS));
        $sortOptions = array_values(array_filter($sortOptions, fn ($v) => array_key_exists($v, self::SORT_LABELS)));
        if (!count($sortOptions)) {
            $sortOptions = array_keys(self::SORT_LABELS);
        }

        $sortDefault = (string) $request->input($prefix . 'sort_default', $sortOptions[0] ?? 'relevance');
        if (!in_array($sortDefault, $sortOptions, true)) {
            $sortDefault = $sortOptions[0] ?? 'relevance';
        }

        $values = (array) $request->input($prefix . 'price_value', []);
        $labels = (array) $request->input($prefix . 'price_label', []);
        $mins = (array) $request->input($prefix . 'price_min', []);
        $maxs = (array) $request->input($prefix . 'price_max', []);

        $priceOptions = [];
        $count = max(count($values), count($labels), count($mins), count($maxs));
        for ($i = 0; $i < $count; $i++) {
            $value = trim((string) ($values[$i] ?? ''));
            $label = trim((string) ($labels[$i] ?? ''));
            $min = $mins[$i] ?? null;
            $max = $maxs[$i] ?? null;

            if ($value === '' || $label === '') {
                continue;
            }

            $priceOptions[] = [
                'value' => $value,
                'label' => $label,
                'min' => $min === '' ? null : $min,
                'max' => $max === '' ? null : $max,
            ];
        }

        if (!count($priceOptions)) {
            $priceOptions = [
                ['value' => 'under-100', 'label' => 'أقل من ١٠٠ ر.س', 'min' => null, 'max' => 99.99],
                ['value' => '100-300', 'label' => '١٠٠ - ٣٠٠ ر.س', 'min' => 100, 'max' => 300],
                ['value' => '300-500', 'label' => '٣٠٠ - ٥٠٠ ر.س', 'min' => 300, 'max' => 500],
                ['value' => 'over-500', 'label' => 'أكثر من ٥٠٠ ر.س', 'min' => 500, 'max' => null],
            ];
        }

        return [
            'sort' => [
                'enabled' => $request->boolean($prefix . 'sort_enabled'),
                'default' => $sortDefault,
                'options' => $sortOptions,
            ],
            'price' => [
                'enabled' => $request->boolean($prefix . 'price_enabled'),
                'options' => $priceOptions,
            ],
            'search' => [
                'enabled' => $request->boolean($prefix . 'search_enabled'),
            ],
            'stock' => [
                'enabled' => $request->boolean($prefix . 'stock_enabled'),
            ],
        ];
    }
}

