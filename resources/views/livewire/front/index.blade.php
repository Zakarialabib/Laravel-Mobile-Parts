<div>
    <div class="relative mx-auto mb-5">
        <div class="w-full mx-auto">
            <!-- Slides -->
            @foreach ($this->sliders as $slider)
                <div class="swiper-slide">
                    <div class="flex flex-wrap -mx-4 py-10 px-4"
                        style="background-image: url({{ asset('images/sliders/' . $slider->photo) }});background-size: cover;background-position: center;">
                        <div class="w-full md:w-1/2 px-4 lg:mb-5 sm:mb-2">
                            <div class="max-w-md lg:py-5 py-10 text-gray-800 px-2">
                                <h5 class="lg:text-2xl sm:text-md font-bold mb-2">
                                    {{ $slider->subtitle }}
                                </h5>
                                <h2 class="lg:text-6xl sm:text-xl font-semibold font-heading">
                                    {{ $slider->title }}
                                </h2>
                                <p class="py-10 lg:text-lg sm:text-sm">
                                    {!! $slider->details !!}
                                </p>
                                @if ($slider->link)
                                    <a class="inline-block hover:bg-green-400 text-white font-bold font-heading py-6 px-8 rounded-md uppercase transition duration-200 bg-green-500"
                                        href="{{ $slider->link }}">
                                        {{ 'Discover now' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-full py-5 px-4 mx-auto">
            <div x-data="{ activeTabs: 'featuredProducts' }">
                <div class="grid gap-4 xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 mb-10 bg-gray-100 border border-gray-800">
                    <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                        @click="activeTabs = 'featuredProducts'">
                        <h4 class="inline-block" :class="activeTabs === 'featuredProducts' ? 'text-green-600' : ''">
                            {{ __('Featured Products') }}
                        </h4>
                    </div>
                    <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                        @click="activeTabs = 'bestOfers'">
                        <h4 class="inline-block" :class="activeTabs === 'bestOfers' ? 'text-green-600' : ''">
                            {{ __('Best Offers') }}
                        </h4>
                    </div>
                </div>
                <div x-show="activeTabs === 'featuredProducts'" class="px-5">
                    <div role="featuredProducts" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0"
                        class="w-full mb-16">
                        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                            @forelse ($this->featuredProducts as $product)
                                <x-product-card :product="$product" />
                            @empty
                                <div class="w-full">
                                    <h3 class="text-3xl font-bold font-heading text-blue-900">
                                        {{ __('No products found') }}
                                    </h3>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div x-show="activeTabs === 'bestOfers'" class="px-5">
                    <div role="bestOfers" aria-labelledby="tab-1" id="tab-panel-1" tabindex="0" class="w-full mb-16">
                        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                            @forelse ($this->bestOffers as $product)
                                <x-product-card :product="$product" />
                            @empty
                                <div class="w-full">
                                    <h3 class="text-3xl font-bold font-heading text-blue-900">
                                        {{ __('No products found') }}
                                    </h3>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 px-4 mx-auto bg-gray-100">
            <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 w-full py-10">
                @forelse ($this->sections as $section)
                    <div class="px-3 mb-6">
                        <div class="relative h-full text-center pt-16 bg-white">
                            <div class="pb-12 border-b">
                                <h3 class="mb-4 text-xl font-bold font-heading">{{ $section->title }}</h3>
                                @if ($section->subtitle)
                                    <p>{{ $section->subtitle }}</p>
                                @endif
                            </div>
                            <div class="py-5 px-4 text-center">
                                <p class="text-lg text-gray-500">
                                    {!! $section->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="container mx-auto py-10">
                        <h2 class="text-4xl font-bold font-heading text-center">{{ __('More Coming Soon') }}</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>