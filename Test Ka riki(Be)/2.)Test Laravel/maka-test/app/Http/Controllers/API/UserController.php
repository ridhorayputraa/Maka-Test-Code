<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ngambil keyword dari depan
        $keyword = $request->query('keyword');
        // Query tunggal biar gampang manggil manggil nya 
        $users = User::query();

        // Jika keyword nya ada langsung nge query berdasarkan keyword
        if ($keyword) {
            $users->where('name', 'like', "%{$keyword}%")->orWhere('address', 'like', "%{$keyword}%");
        }

        // Ngambil data yang udah di query either ada keyword atau nggak
        $users = $users->get();

        // Tinggal return datanya ke depan
        // Disini saya pake helper agar konsisten ngirim format datanya -> ResponseFormatter
        if ($users->isEmpty()) {
            // Kalo data users nya gada kirim 404
            return ResponseFormatter::error(null, 'Data not found', 404);
        }
        return ResponseFormatter::success($users, 'Data Berhasil di get');
    }


    public function show($id){
        $user = User::find($id);
        if (!$user) {
            return ResponseFormatter::error(
                null,
                'Data not found',
                404
            );
        }

     return ResponseFormatter::success(
        $user,
        'Data user succesfull given'
     );
    }


    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'name' => 'required|max:20',
                'address' => 'required|max:100',
                'image_url' => 'required|image|max:2048',
            ]);

            if ($validateData->fails()) {
                return ResponseFormatter::error(
                    ['error' => $validateData->errors()],
                    'Gagal Simpan Data',
                    401
                );
            }

            $imagePath = $request->file('image_url')->store('public/assets/user');
            $imageUrl = Storage::url($imagePath);

            // Simpan url nya ke field image
            // Dan kirimkan gambarnya ke assets 
            $DataUser = User::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'image_url' => $imageUrl, // Gunakan URL gambar yang sudah diubah
                // 'image_url' => $request->file('image_url')->store('/public/assets/user'),
            ]);

            return ResponseFormatter::success(
                $DataUser,
                'Data user berhasil di buat'
            );
        } catch (Exception $e) {
            return ResponseFormatter::error(
                $e->getMessage(),
                'Terjadi kesalahan',
                500
            );
        }
    }


    public function update(Request $request, $id)
    {
        try {

            // Validasi data input
            $validateData = Validator::make($request->all(), [
                'name' => 'max:20',
                'address' => 'max:100',
                'image_url' => 'image|max:2048',
            ]);

            if ($validateData->fails()) {
                return ResponseFormatter::error(
                    ['error' => $validateData->errors()],
                    'Gagal Validasi',
                    422
                );
            }

        
            $user = User::find($id);

            if (!$user) {
                return ResponseFormatter::error(
                    null,
                    'Data user tidak ditemukan',
                    404
                );
            }


            $user->fill($request->all());

            if ($request->hasFile('image_url')) {
                // Jika ada file gambar yang diunggah, simpan gambar baru
                $imagePath = $request->file('image_url')->store('public/assets/user');
                $user->image_url = $imagePath;
            }

            $user->save();

            return ResponseFormatter::success($user, "Profile Updated");
        } catch (Exception $e) {
            return ResponseFormatter::error(
                $e->getMessage(),
                'Terjadi kesalahan',
                500
            );
        }
    }


    public function destroy($id){
        $dataUser = User::find($id);

        if (!$dataUser) {
            return ResponseFormatter::error(null, 'Data user tidak ditemukan', 404);
        }

        $dataUser->delete();
        return ResponseFormatter::success($dataUser, 'User deleted');

    }


}
