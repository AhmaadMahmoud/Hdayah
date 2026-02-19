<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FilterConfig;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(Request $request, Category $category): View
    {
        $config = $this->normalizeConfig(FilterConfig::getConfig('categories'));

        $query = Product::with(['images', 'category'])
            ->where('category_id', $category->id);

        // بحث داخل التصنيف
        $search = null;
        if ($config['search']['enabled']) {
            $search = trim((string) $request->input('q', ''));
            if ($search !== '') {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }
        }

        // فلتر سعر
        $selectedPrices = [];
        if ($config['price']['enabled']) {
            $selectedPrices = array_values(array_intersect(
                (array) $request->input('price', []),
                array_column($config['price']['options'], 'value')
            ));

            if (count($selectedPrices)) {
                $ranges = array_values(array_filter($config['price']['options'], function ($opt) use ($selectedPrices) {
                    return in_array($opt['value'], $selectedPrices, true);
                }));

                $query->where(function ($q) use ($ranges) {
                    foreach ($ranges as $range) {
                        $min = $range['min'];
                        $max = $range['max'];

                        if ($min !== null && $max !== null) {
                            $q->orWhereBetween('price', [(float) $min, (float) $max]);
                        } elseif ($min !== null) {
                            $q->orWhere('price', '>=', (float) $min);
                        } elseif ($max !== null) {
                            $q->orWhere('price', '<=', (float) $max);
                        }
                    }
                });
            }
        }

        // فلتر مخزون
        $stockFilter = null;
        if ($config['stock']['enabled']) {
            $stockFilter = $request->input('stock');
            if ($stockFilter === 'instock') {
                $query->where('stock', '>', 0);
            } elseif ($stockFilter === 'out') {
                $query->where('stock', '=', 0);
            }
        }

        // ترتيب
        $sort = $request->input('sort', $config['sort']['default']);
        if (!in_array($sort, $config['sort']['options'], true)) {
            $sort = $config['sort']['default'];
        }
        $this->applySort($query, $sort);

        $products = $query->paginate(16)->withQueryString();

        return view('frontend.categories.index', [
            'category' => $category,
            'products' => $products,
            'filtersEnabled' => $config,
            'sort' => $sort,
            'search' => $search,
            'selectedPrices' => $selectedPrices,
            'stockFilter' => $stockFilter,
        ]);
    }

    private function applySort($query, string $sort): void
    {
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                return;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                return;
            case 'latest':
                $query->latest();
                return;
            case 'relevance':
            default:
                $query->latest();
                return;
        }
    }

    private function normalizeConfig(array $raw): array
    {
        $defaultPriceOptions = [
            ['value' => 'under-100', 'label' => 'أقل من ١٠٠ ر.س', 'min' => null, 'max' => 99.99],
            ['value' => '100-300', 'label' => '١٠٠ - ٣٠٠ ر.س', 'min' => 100, 'max' => 300],
            ['value' => '300-500', 'label' => '٣٠٠ - ٥٠٠ ر.س', 'min' => 300, 'max' => 500],
            ['value' => 'over-500', 'label' => 'أكثر من ٥٠٠ ر.س', 'min' => 500, 'max' => null],
        ];

        $sortEnabled = array_key_exists('sort', $raw) ? (bool) data_get($raw, 'sort.enabled', true) : true;
        $sortDefault = (string) data_get($raw, 'sort.default', 'relevance');
        $sortOptions = (array) data_get($raw, 'sort.options', ['relevance', 'price_asc', 'price_desc', 'latest']);
        $sortOptions = array_values(array_intersect($sortOptions, ['relevance', 'price_asc', 'price_desc', 'latest']));
        if (!count($sortOptions) && !isset($raw['sort']['options'])) {
            $sortOptions = ['relevance', 'price_asc', 'price_desc', 'latest'];
        }
        if (count($sortOptions) && !in_array($sortDefault, $sortOptions, true)) {
            $sortDefault = $sortOptions[0];
        }

        $priceEnabled = array_key_exists('price', $raw) ? (bool) data_get($raw, 'price.enabled', true) : true;
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
        if (!count($priceOptions) && !isset($raw['price']['options'])) {
            $priceOptions = $defaultPriceOptions;
        }

        $searchEnabled = array_key_exists('search', $raw) ? (bool) data_get($raw, 'search.enabled', true) : true;
        $stockEnabled = array_key_exists('stock', $raw) ? (bool) data_get($raw, 'stock.enabled', true) : true;

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
}

