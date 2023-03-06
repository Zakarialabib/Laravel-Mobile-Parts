<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public array $paginationOptions;

    public $category_id;

    public $subcategory_id;

    public $brand_id;

    public $sorting;

    public $sortingOptions;

    public $selectedFilters = [];

    protected $queryString = [
        'category_id' => ['except' => '', 'as' => 'c'],
        'subcategory_id' => ['except' => '', 'as' => 's'],
        'sorting' => ['except' => '', 'as' => 'f'],
    ];

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function filterProducts($type, $value)
    {
        switch($type) {
            case 'category':
                $this->category_id = $value;

                break;
            case 'subcategory':
                $this->subcategory_id = $value;

                break;
            case 'brand':
                $this->brand_id = $value;

                break;
        }
        $this->resetPage();
    }

     public function clearFilter($filter)
     {
         switch($filter) {
             case 'category':
                 $this->category_id = null;
                 unset($this->selectedFilters['category']);

                 break;
             case 'subcategory':
                 $this->subcategory_id = null;
                 unset($this->selectedFilters['subcategory']);

                 break;
         }
         $this->resetPage();
     }

    public function mount()
    {
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->sortingOptions = [
            'name-asc' => __('Order Alphabetic, A-Z'),
            'name-desc' => __('Order Alphabetic, Z-A'),
            'price-asc' => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc' => __('Date, new to old'),
            'date-desc' => __('Date, old to new'),
        ];
    }

    public function getCategoriesProperty()
    {
        return Category::active()->with('subcategories')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::active()->get();
    }

    public function render(): View|Factory
    {
        $query = Product::active()
            ->when($this->category_id, function ($query) {
                return $query->where('category_id', $this->category_id);
            })
            ->when($this->subcategory_id, function ($query) {
                return $query->where('subcategory_id', $this->subcategory_id);
            });

        if ($this->sorting === 'name') {
            $products = $query->orderBy('name', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'name-desc') {
            $products = $query->orderBy('name', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting === 'price') {
            $products = $query->orderBy('price', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'price-desc') {
            $products = $query->orderBy('price', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting === 'date') {
            $products = $query->orderBy('created_at', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'date-desc') {
            $products = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        } else {
            $products = $query->paginate($this->perPage);
        }

        return view('livewire.front.categories', compact('products'));
    }
}
