@foreach($products as $product)
<tr>
    <td>{{ $product->name }}</td>
    <td>{{ $product->brand }}</td>
    <!-- ... kolom lain ... -->
    <td>
        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
        
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Delete</button>
        </form>
    </td>
</tr>
@endforeach
