@extends('layouts.app')

@section('title', __('Home'))

@section('content')
    <div class="w-full flex">
        <div class="hidden md:block md:w-1/4 h-auto bg-green-600 overflow-scroll-y">
            <div x-data="{ isCategory: true }" class="pl-10 py-5">
                <button @click="isCategory = !isCategory"
                    class="font-bold text-white text-xl hover:text-gray-800 border-b border-white hover:underline">
                    <span>{{ __('Categories') }}</span>
                    <i class="fas fa-angle-down pl-5" ></i>
                </button>
                <div x-show="isCategory">
                    <div class="py-2 space-y-4">
                        <ul class="font-semibold font-heading">
                            @foreach (\App\Helpers::getActiveCategories() as $category)
                                <li>
                                    <a href="{{ route('front.categories') }}?c={{ $category->id }}"
                                        class="text-lg text-gray-100 text-center font-semibold leading-5 font-heading hover:text-gray-800 hover:underline">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="mx-4">
            <div x-data="{ isOpen: true }" class="pl-10 py-5">
                <button @click="isOpen = !isOpen"
                    class="font-bold text-white text-xl hover:text-gray-800 border-b border-white hover:underline">
                    <span>{{ __('Brands') }}</span>
                    <i class="fas fa-angle-down pl-5" ></i>
                </button>
                <div x-show="isOpen">
                    <div class="py-2 space-y-4">
                        <ul class="font-semibold font-heading">
                            @foreach (\App\Helpers::getActiveBrands() as $brand)
                                <li>
                                    <a href="{{ route('front.brands') }}?c={{ $brand->id }}"
                                        class="text-lg text-gray-100 text-center font-semibold leading-5 font-heading hover:text-gray-800 hover:underline">
                                        {{ $brand->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="mx-4">
        </div>

        <div class="w-full md:w-3/4">
            <livewire:front.index />
        </div>
    </div>
@endsection
