<div class="row">
    <form action="{{route('products.update', ['product' => $product->id])}}" method="post" class="col-md-12">
        @csrf
        {{ method_field('PUT') }}
        <div class="col-md-4 col-sm-4 col-sm-4 col-xs-4">
            <div class="form-group">
                <label for="name" class="control-label">Назва продукту</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name') ?? $product->name}}" required autocomplete="name" id="product">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-sm-4 col-xs-4">
            <div class="form-group">
                <label for="button" class="control-label">&nbsp;</label>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Зберегти
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="col-md-4 col-sm-4 col-sm-4 col-xs-4">
        <div class="form-group">
            <form action="{{route('products.destroy', ['product' => $product->id])}}" method="post">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger">
                    {{__('messages.delete')}}
                </button>
            </form>
        </div>
    </div>
</div>

