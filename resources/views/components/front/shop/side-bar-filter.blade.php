
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">

    <div wire:ignore class="widget mercado-widget filter-widget brand-widget">
        <h2 class="widget-title">@lang('text.All Categories')</h2>
        <div class="widget-content">
            <ul class="list-style vertical-list list-limited" data-show="6">
                @forelse(\App\Models\Category::latest()->get() as $category)
                    <li class="list-item category_name {{$loop->index > 5 ? 'default-hiden':''}}" style=" height: 150px;border-radius: 20px;padding: 3px; background-image: url('{{$category->id == 1 ? (app()->getLocale() == "ar" ? asset("images/categories/other_ar.png"):asset("images/categories/other_en.png")) : $category->image}}');background-size: cover">
                        <input id="cat-{{$loop->index}}" name="category" type="radio" value="{{$category->id}}" wire:model="category">
                        <label for="cat-{{$loop->index}}" class="mx-1" style="position: absolute;width: 100%;height: 100px"> {{$category->id != 1 ?(app()->getLocale() == 'ar' ? $category->name_ar:$category->name_en):''}}</label>
                    </li>
                @empty
                    <li class="list-item">{{__('text.No Categories available Yet')}}</li>
                @endforelse
                @if(\App\Models\Category::count() > 6)
                    <li class="list-item"><a data-label='@lang('text.Show less')<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">@lang('text.Show more')<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                @endif

            </ul>
        </div>
    </div><!-- brand widget-->

    <div class="widget mercado-widget filter-widget price-filter">
        <h2 class="widget-title">@lang('text.Price')</h2>
        <div class="widget-content row">
            <div class="form-group">
                <label for="amount-1">@lang('text.Min Price'):</label>
                <input type="text" id="amount-1" class="form-control" wire:model="min_price">
            </div>
            <div class="form-group">
                <label for="amount-2">@lang('text.Max Price'):</label>
                <input type="text" id="amount-2" class="form-control" wire:model="max_price">
            </div>
        </div>
    </div><!-- Price-->

    <x-front.products.popular-products :products="$products" />
</div>

