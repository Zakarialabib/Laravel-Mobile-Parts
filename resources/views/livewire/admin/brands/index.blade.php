<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-wrap my-md-0 my-2">
            <select wire:model="perPage"
                class="w-20 border border-gray-300 rounded-md shadow-sm py-2 px-4 bg-white text-sm leading-5 font-medium text-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out">
                @foreach ($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            @if($this->selected)
            <x-button danger type="button"  wire:click="deleteSelected" class="ml-3">
                <i class="fas fa-trash-alt"></i>
            </x-button>
            @endif
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="flex items-center mr-3 pl-4">
                <input wire:model="search" type="text"
                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pr-10"
                    placeholder="{{__('Search...')}}" />
            </div>
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th class="pr-0 w-8">
                <input wire:model="selectPage" type="checkbox" />
            </x-table.th>
            <x-table.th>
                {{ __('Name') }}
            </x-table.th>
            <x-table.th>
                {{ __('Slug') }}
            </x-table.th>
            <x-table.th>
                {{ __('Image') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
            </tr>
        </x-slot>
        <x-table.tbody>
            @forelse($brands as $brand)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $brand->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $brand->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        {{ $brand->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $brand->slug }}
                    </x-table.td>
                    <x-table.td>
                        @if ($brand->image)
                        <img src="{{ asset('images/brands/' . $brand->image) }}" alt="{{ $brand->name }}"
                            class="w-10 h-10 rounded-full">
                        @else
                        {{__('No image')}}
                        @endif
                    </x-table.td>
                    <x-table.td>
                        <div class="flex justify-start space-x-2">
                            <x-button primary type="button" wire:click="$emit('editModal', {{ $brand->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-button danger type="button" wire:click="$emit('deleteModal', {{ $brand->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-trash-alt"></i>
                            </x-button>
                        </div>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="10" class="text-center">
                        {{ __('No entries found.') }}
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-table.tbody>
    </x-table>

    <div class="p-4">
        <div class="pt-3">
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $brands->links() }}
        </div>
    </div>

    <!-- Edit Modal -->
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Brand') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="flex flex-wrap -mx-3 mb-6">

                    <div class="xl:w-1/2 md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.defer="brand.name" />
                        <x-input-error :messages="$errors->get('brand.name')" for="brand.name" class="mt-2" />
                    </div>

                    <div class="xl:w-1/2 md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-label for="slug" :value="__('Slug')" />
                        <x-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                            wire:model.defer="brand.slug" />
                        <x-input-error :messages="$errors->get('brand.slug')" for="brand.slug" class="mt-2" />
                    </div>

                    <div class="w-full px-3 mb-6 md:mb-0">
                        <x-label for="description" :value="__('Description')" />
                        <x-input.textarea wire:model.lazy="brand.description" id="description" />
                        <x-input-error :messages="$errors->get('brand.description')" for="brand.description" class="mt-2" />
                    </div>

                    <div class="w-full py-2 px-3 mb-4">
                        <x-label for="Brand Logo" :value="__('Brand Logo')" />
                        <x-media-upload title="{{ __('Brand Logo') }}" name="image" wire:model="image"
                                :file="$image" :preview="$this->imagepreview" single types="PNG / JPEG / WEBP"
                                fileTypes="image/*" />
                    </div>

                    <div class="w-full py-2 px-3 mb-4">
                        <x-label for="Brand Logo" :value="__('Featured image')" />
                        <x-media-upload title="{{ __('Featured Image') }}" name="featured_image"
                             :file="$featured_image" :preview="$this->featuredimagepreview" single types="PNG / JPEG / WEBP"
                            fileTypes="image/*" />
                    </div>

                    <div class="w-full px-3 my-2">
                        <x-button primary type="submit" wire:loading.attr="disabled">
                            {{ __('Update') }}
                        </x-button>
                        <span class="sr-only ml-2" wire:loading wire:target="update">
                            {{ __('Updating...') }}
                        </span>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Edit Modal -->

    <livewire:admin.brands.create />

</div>

@push('page_scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('deleteModal', brandId => {
                Swal.fire({
                    title: __("Are you sure?") ,
                    text: __("You won't be able to revert this!") ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: __("Yes, delete it!") 
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', brandId)
                    }
                })
            })
        })
    </script>
@endpush
