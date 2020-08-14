@extends('layouts.admin.form')

@section('pagetitle')
Admin | Product Management: {{ isset($product->productslug) ? 'Edit '.ucfirst($product->genre) : 'Add '.ucfirst($product->genre) }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-example-wrap mg-t-30">
                <form name="createproductfrm" id="createproductfrm" action="{{ route('admin.saveproduct') }}">
                    @csrf
                    <div class="cmp-tb-hd cmp-int-hd">
                        <h2>Create {{ ucfirst($product->genre) }}.</h2>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Name</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="productname" id="productname" class="form-control input-sm" placeholder="Name of your product" value="{{ isset($product->productname) ? $product->productname : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">SKU</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="productsku" id="productsku" class="form-control input-sm" placeholder="Name of your product" value="{{ isset($product->productsku) ? $product->productsku : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Browser Title</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="browsertitle" id="browsertitle" class="form-control input-sm" placeholder="Title for your browser" value="{{ isset($product->browsertitle) ? $product->browsertitle : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Meta Keyword</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="metakeyword" id="metakeyword" class="form-control input-sm" placeholder="Keywords for your product" value="{{ isset($product->metakeyword) ? $product->metakeyword : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Meta Description</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="metadescription" id="metadescription" class="form-control input-sm" placeholder="Description of your product" value="{{ isset($product->metadescription) ? $product->metadescription : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">{{ ucfirst($product->genre) }} Description</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <textarea name="description" id="description">{{ isset($product->description) ? $product->description : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(count((array)$product->specification) > 0)
                        @php
                        $count = 1;
                        $totalspecs =  count((array)$product->specification);
                        @endphp
                        @foreach($product->specification as $entry)
                        <div class="form-example-int form-horizental specsection" id="specdiv-{{ $count }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        @if($count == 1)
                                        <label class="hrzn-fm" id="specLabel">{{ ucfirst($product->genre) }} Specification</label>
                                        @endif
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                        <div class="nk-int-st">
                                            <input type="text" name="specname[]" id="specname-{{ $count }}" class="form-control input-sm" placeholder="Specification title" value="{{ isset($entry->specname) ? $entry->specname : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                        <div class="nk-int-st">
                                            <input type="text" name="specification[]" id="specification-{{ $count }}" class="form-control input-sm" placeholder="Specification of your product" value="{{ isset($entry->specification) ? $entry->specification : '' }}">
                                        </div>
                                    </div>
                                    @if($count > 1)
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <div class="nk-int-st">
                                            <button type="button" id="specremove-{{ $count }}" data-specs-count="{{ $totalspecs }}" class="btn"><i class="notika-icon notika-minus-symbol"></i></button>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <div class="nk-int-st">
                                            <button type="button" id="specsadd" data-specs-count="{{ $totalspecs }}" class="btn"><i class="notika-icon notika-plus-symbol"></i></button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php $count++; @endphp
                        @endforeach
                    @else
                    <div class="form-example-int form-horizental specsection" id="specdiv-1">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm" id="specLabel">{{ ucfirst($product->genre) }} Specification</label>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <div class="nk-int-st">
                                        <input type="text" name="specname[]" id="specname-1" class="form-control input-sm" placeholder="Specification title" value="{{ isset($product->metadescription) ? $product->metadescription : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                    <div class="nk-int-st">
                                        <input type="text" name="specification[]" id="specification-1" class="form-control input-sm" placeholder="Specification of your product" value="{{ isset($product->metadescription) ? $product->metadescription : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <div class="nk-int-st">
                                        <button type="button" id="specsadd" data-specs-count="1" class="btn"><i class="notika-icon notika-plus-symbol"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">{{ ucfirst($product->genre) }} Category</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <div class="chosen-select-act fm-cmp-mg">
                                            <select class="chosen" name="productcategory" id="productcategory" data-placeholder="Category of your product">
                                                <option value=""></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($category->id == $product->category) ? 'selected' : '' }}>{{ $category->categoryname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">{{ ucfirst($product->genre) }} Brand</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <div class="chosen-select-act fm-cmp-mg">
                                            <select class="chosen" name="productbrand" id="productbrand" data-placeholder="Brand of your product">
                                                <option value=""></option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ ($brand->id == $product->brand) ? 'selected' : '' }}>{{ $brand->brandname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">{{ ucfirst($product->genre) }} Style</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <div class="chosen-select-act fm-cmp-mg">
                                            <select class="chosen" name="productstyle" id="productstyle" data-placeholder="Style of your product">
                                                <option value=""></option>
                                                @foreach($styles as $style)
                                                    <option value="{{ $style->id }}" {{ ($style->id == $product->style) ? 'selected' : '' }}>{{ $style->stylename }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">{{ ucfirst($product->genre) }} Material</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <div class="chosen-select-act fm-cmp-mg">
                                            <select class="chosen" name="productmaterial" id="productmaterial" data-placeholder="Material of your product">
                                                <option value=""></option>
                                                @foreach($materials as $material)
                                                    <option value="{{ $material->id }}" {{ ($material->id == $product->material) ? 'selected' : '' }}>{{ $material->materialname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">{{ ucfirst($product->genre) }} Price</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="productprice" id="productprice" class="form-control input-sm" placeholder="Price" value="{{ isset($product->price) ? $product->price : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="productdiscount" id="productdiscount" class="form-control input-sm" placeholder="Discount" value="{{ isset($product->discount) ? $product->discount : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-1 col-sm-1 col-xs-12">
                                    <div class="nk-int-st">
                                        <div class="chosen-select-act fm-cmp-mg">
                                            <select class="chosen" name="productdiscountby" id="productdiscountby" data-placeholder="Discount By">
                                                <option value=""></option>
                                                <option value="Amount" {{ ($product->discountby == 'Amount') ? 'selected' : '' }}>Amount</option>
                                                <option value="Percentage" {{ ($product->discountby == 'Percentage') ? 'selected' : '' }}>Percentage</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">{{ ucfirst($product->genre) }} Image</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="dropzone dropzone-nk needsclick dz-clickable" id="imageUploader" data-file="{{ isset($product->image) ? $product->image : '' }}" data-link="{{ isset($product->image_link) ? asset($product->image_link) : '' }}" data-size="{{ isset($product->image_size) ? $product->image_size : '' }}">
                                            <div class="dz-message needsclick download-custom">
                                                <i class="notika-icon notika-cloud"></i>
                                                <h2>Drop files here or click to upload.</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int mg-t-15">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <input type="hidden" name="productimage" id="productimage">
                                <input type="hidden" name="genre" id="genre" value="{{ $product->genre }}">
                                <input type="hidden" name="productslug" id="productslug" value="{{ isset($product->productslug) ? $product->productslug : '' }}">
                                <button type="submit" class="btn btn-success notika-btn-success waves-effect">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    var genre = "{{ $product->genre }}";
</script>
@section('page_scrypt')
<script src="{{ asset('adminassets/js/module-scripts/product.js') }}"></script>
@endsection
