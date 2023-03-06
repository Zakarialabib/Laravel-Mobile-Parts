@props(['product'])
<div>
    <div class="mb-5 bg-white rounded-lg shadow-2xl">
        <div>
            <div class="relative text-center">
                <a href="{{ route('front.product', $product->slug) }}" >
                    <img class="w-full h-[300px] object-cover rounded-t-lg py-5"
                        src="{{ asset('images/products/' . $product->image) }}"
                        onerror="this.onerror=null; this.remove();" alt="{{ $product->name }}" loading="lazy">
                    <meta content="{{ asset('images/products/' . $product->image) }}">
                </a>

                @if ($product->old_price && $product->discount != 0)
                    <div class="absolute top-0 right-0 mb-3 p-2 bg-red-500 rounded-bl-lg">
                        @auth
                            <span class="text-white font-bold text-sm">
                                - {{ $product->discount }}
                            </span>
                        @endauth
                        %
                    </div>
                @endif
            </div>
            <div class="px-2 pb-4 pt-10 text-center">
                <a href="{{ route('front.product', $product->slug) }}"
                    class="block mb-2 text-md font-bold font-heading hover:text-green-400">
                    {{ $product->name }}
                </a>
                @if ($product->status == 1)
                    <div class="bg-green-500 py-2 mx-auto rounded-full">
                        <span class="text-sm text-white font-bold">● {{ __('In Stock') }}</span>
                    </div>
                @else
                    <div class="bg-green-500 py-2 mx-auto rounded-full">
                        <span class="text-sm text-white font-bold">●
                            {{ __('Out of Stock') }}</span>
                    </div>
                @endif

                @auth
                    <span class="hover:text-orange-900 font-bold text-md mt-2">{{ $product->price }}
                        DH</span>
                    @if ($product->old_price && $product->discount != 0)
                        <p class="text-black font-bold text-sm block my-2">
                            <del>{{ $product->old_price }} DH </del>
                        </p>
                    @endif

                    <div class="flex justify-center">
                        <livewire:front.add-to-cart :product="$product" :key="$product->id" />
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
