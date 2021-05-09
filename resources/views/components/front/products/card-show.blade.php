@forelse($products as $product)
    <div class="col-4">
        <div class="news-grid">
            <div class="news-grid-image">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            @if ($product->type == 'group')
                                <span class="property-label badge badge-warning" style="position: absolute">{{__('text.Group')}}</span>
                            @endif
                            <img src="{{$product->image}}" class="d-block w-100" alt="...">
                        </div>
                        @foreach($product->images as $image)
                            <div class="carousel-item">
                                @if ($product->type == 'group')
                                    <span class="property-label badge badge-warning" style="position: absolute">{{__('text.Group')}}</span>
                                @endif
                                    <img src="{{$image->name}}" class="img-fluid d-block w-100 h-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="news-grid-box">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle card-drop arrow-none text-white" data-toggle="dropdown" aria-expanded="false">
                            <div><i class="mdi mdi-dots-horizontal h4 m-0 text-muted"></i></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if ($product->user_id == auth()->user()->id)
                                <a class="dropdown-item" href="/admin/products-update/{{$product->id}}-{{$product->slug}}">{{__('text.Edit')}}</a>
                            @endif
                            <button class="dropdown-item" type="button" wire:click="confirmDelete({{$product->id}})">{{__('text.Delete')}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="news-grid-txt">
                <h2>{{app()->getLocale() == 'ar' ?$product->name_ar:$product->name_en}}</h2>
                @if ($product->type == 'group')
                    <div class="mb-0">
                        @foreach($product->groups as $single)
                            {{app()->getLocale() == 'ar' ?$single->name_ar:$single->name_en}} ({{$single->pivot->quantity}}) {{$loop->last ? '': '+' }}
                        @endforeach
                    </div>
                @endif
                <ul>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i> {{date('M d Y',strtotime($product->created_at))}}</li>
                    <li><i class="fa fa-user" aria-hidden="true"></i> {{auth()->user()->name}}</li>
                </ul>
                <ul>
                    <li><i class="mdi mdi-whatsapp" aria-hidden="true"></i> {{$product->whatsapp}}</li>
                    <li><i class="mdi mdi-cellphone" aria-hidden="true"></i> {{$product->phone}}</li>
                </ul>
                @if (!$product->sale)
                    <span class="text-pink"> {{__('text.Price')}} </span>| <span class="text-muted">{{$product->price}} L.E</span>
                @else
                    <span class="text-pink"> {{__('text.Price')}} </span>| <span class="text-muted"><del>{{$product->price}}</del> {{$product->sale}} L.E</span>
                @endif
                <br><span class="text-pink"> {{__('text.Year of Manufacture')}} </span>| <span class="text-muted">{{$product->YearOfManufacture}}</span>
                <br><span class="text-pink">{{__('text.Category Name')}}</span>
                <ul class="slimscroll listCatScroll" >
                    @foreach($product->categories as $cat)
                        <li>
                        |<span class="text-pink">
                            <a href="/admin/category/{{$cat->id}}-{{$cat->slug}}" >{{app()->getLocale() == 'ar'? $cat->name_ar : $cat->name_en}}</a>
                        </span>|
                        </li>
                    @endforeach
                </ul>
                <span class="text-pink">{{__('text.Description')}}</span>
                <div class="slimscroll description_scroll mb-0">{{app()->getLocale() == 'ar' ?$product->description_ar:$product->description_en}}</div>
                <hr>
                <button id="changeFeatured" wire:click.prevent="updateFeatured({{$product->id}})" class="btn btn-{{$product->featured == 0 ? "secondary":"primary"}} mt-3 btn-rounded btn-bordered waves-effect width-md waves-light text-white d-block mx-auto w-75">{{__('text.Featured')}} <i class="far fa-star"></i></button>
            </div>
        </div>
    </div>
@empty
    <h1 class='text-center flex-grow-1'>{{__('text.No Data Yet')}}</h1>
@endforelse
