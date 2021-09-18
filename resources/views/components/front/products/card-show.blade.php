<div style="min-height: 550px;" class="my-5">
    <div class="row justify-content-center my-2">
        <input wire:model="search" type="text" class="form-control col-4" style="width: 33.33%!important;" placeholder="{{__('text.Search')}}...">
    </div>
    @forelse($myProducts as $product)
        <div class="myProducts-front col-4 px-0">
            <div class="news-grid ">
                <div class="news-grid-image h-auto">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active"@if (app()->getLocale() == 'ar')
                            style="float: left!important;margin-left: 0!important;margin-right: -100%"
                                @endif>
                                @if ($product->type == 'group')
                                    <span class="property-label badge badge-warning" style="position: absolute">{{__('text.Group')}}</span>
                                @endif
                                <img src="{{$product->image}}" class="d-block w-100" alt="...">
                            </div>
                            @foreach($product->images as $image)
                                <div class="carousel-item" @if (app()->getLocale() == 'ar')
                                    style="float: left!important;margin-left: 0!important;margin-right: -100%"
                                @endif>
                                    @if ($product->type == 'group')
                                        <span class="property-label badge badge-warning" style="position: absolute">{{__('text.Group')}}</span>
                                    @endif
                                    <img src="{{$image->name}}" class="img-fluid d-block w-100 h-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if ($product->vendor_id == auth()->guard('vendor')->user()->id)
                        <div class="news-grid-box p-0 d-flex flex-row justify-content-center align-items-center">
                            <div class="dropdown ">
                                <a href="#" class="dropdown-toggle card-drop arrow-none text-white" data-toggle="dropdown" aria-expanded="false">
                                    <div><i class="fas fa-ellipsis-h h4 m-0 text-dark"></i></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" style="right: auto!important;">
                                    <a class="dropdown-item" href="/products-update/{{$product->id}}-{{$product->slug}}">{{__('text.Edit')}}</a>
                                    <button class="dropdown-item" type="button" wire:click="confirmDelete({{$product->id}})">{{__('text.Delete')}}</button>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="news-grid-txt">
                    <h2><a href="{{route('front.viewDetail',[$product->id,$product->slug])}}">{{app()->getLocale() == 'ar' ?$product->name_ar:$product->name_en}}</a></h2>
                    @if ($product->type == 'group')
                        <div class="mb-0">
                            @foreach($product->groups as $single)
                                {{app()->getLocale() == 'ar' ?$single->name_ar:$single->name_en}} ({{$single->pivot->quantity}}) {{$loop->last ? '': '+' }}
                            @endforeach
                        </div>
                    @endif
                    <ul>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> {{date('M d Y',strtotime($product->created_at))}}</li>
                        <li><i class="fa fa-user" aria-hidden="true"></i> {{auth()->guard('vendor')->user()->name}}</li>
                    </ul>
                    <ul>
                        <li><i class="fa fa-whatsapp" aria-hidden="true"></i> {{$product->whatsapp}}</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{$product->phone}}</li>
                    </ul>
                    @if (!$product->sale)
                        <span class="text-pink"> {{__('text.Price')}} </span><br> <span class="text-muted">{{$product->price}} L.E</span>
                    @else
                        <span class="text-pink"> {{__('text.Price')}} </span><br> <span class="text-muted"><del>{{$product->price}}</del> {{$product->sale}} L.E</span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <h1 class='text-center '>{{__('text.No Data Yet')}}</h1>
    @endforelse
    <!-- pagination -->
    <div>
        {{$myProducts->links()}}
    </div>
</div>

