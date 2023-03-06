<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Phone;

use App\Http\Livewire\WithSorting;
use App\Models\Phone;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Throwable;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    use WithSorting;
    use WithFileUploads;

    public $image;

    public $phone;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'editModal', 'delete',
        'sync',
    ];

    public $refreshIndex;

    public $showModal = false;

    public $editModal = false;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    protected $rules = [
        'phone.name' => 'required',
        'phone.brand_id' => 'required',
        'phone.slug' => 'nullable',
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Phone())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Phone::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $phones = $query->paginate($this->perPage);

        return view('livewire.admin.phone.index', compact('phones'));
    }

      // Phone  Delete
      public function delete(Phone $phone)
      {
          abort_if(Gate::denies('phone_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

          $phone->delete();

          $this->alert('warning', __('Phone Deleted successfully!'));
      }

     public function editModal(Phone $phone)
     {
         $this->resetErrorBag();

         $this->resetValidation();

         $this->phone = $phone;

         $this->editModal = true;
     }

     public function update()
     {
         try {
             $this->validate();

             if ($this->image) {
                 $imageName = Str::slug($this->phone->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
                 $this->image->storeAs('phones', $imageName);
                 $this->phone->image = $imageName;
             }

             $this->phone->save();

             $this->alert('success', __('Phone updated successfully!'));

             $this->editModal = false;
         } catch (Throwable $th) {
             $this->alert('warning', __('Phone was not updated!'));
         }
     }
     

    public function sync()
    {
        $data = Http::get("http://127.0.0.1:8000/public/brands.json")->json();

        dd($data);
        foreach ($data['data']['phones'] as $item) {
            $brand = $item['brand'];
            $name = $item['phone_name'];
            $slug = $item['slug'];
            $image = $item['image'];

            $phone = Phone::create([
                'brand_id' => $brand,
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
            ], $data);
            $phone->save();
        }

        $this->phone = Phone::save($phone);
    }
  
}
