<div class="row">
    <x-front.shop.main :products="$allProducts" :sort="$sort" :pagination="$pagination"/>
    <x-front.shop.side-bar-filter :products="$highest_products_review" />
</div>
