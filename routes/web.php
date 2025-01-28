

use Illuminate\Support\Facades\Route;
use App\Models\Produto;
use App\Http\Controllers\ProdutoController;


Route::get('/', function () {
    return view('index.html');
});
Route::get('/item', function () {
    return view('item');
});
Route::get('/carrinho', function () {
    return view('carrinho');
});
Route::get('/fazerPedido', function () {
    return view('fazerPedido');
});
Route::get('/api/produtos', [ProdutoController::class, 'listar'], function () {
    $produtos = App\Models\Produto::all()->map(function ($produto) {
        $produto->img_url = url('/storage/produtos' . $produto->img); // Gera a URL completa da imagem
        return $produto;
    });

    return response()->json($produtos);
});
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
