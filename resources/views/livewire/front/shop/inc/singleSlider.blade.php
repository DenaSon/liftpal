<a href="#" class="swap-image">
    <img src="{{ asset($product->images->first()->file_path ?? '') }}" class="swap-to img-thumbnail rounded-0" height="250" alt="{{ $product->name }}" style="height: 330px;
    width: auto">
    <img src="{{ asset($product->images->count() > 1 ? $product->images[1]->file_path : $product->images->first()->file_path ?? '') }}"
         class="swap-from img-thumbnail rounded-0" height="250"  alt="{{ $product->name }}" style="height: 330px;width: auto" >
</a>




