<?php

namespace App\Http\Controllers;

use File;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /* Array Group By */
    protected function returnUniqueArrayAttribute($array, $key)
    {
        $result = [];
        foreach ($array as $i) {
            if (!isset($result[$i->{$key}])) {
                $result[$i->{$key}] = $i;
            }
        }
        sort($result);
        return $result;
    }

    protected function success($message = 'Permintaan berhasil diproses', $data = [])
    {
        $response['data'] = $data->items();
        $response['message'] = $message;
        $response['status'] = SUKSES;
        $response['current_page'] = $data->currentPage();
        $response['total_page'] = $data->lastPage();
        $response['total_row_current_page'] = $data->count();
        $response['total_data'] = $data->total();

        return response()->json($response);
    }

    // pesan untuk ambil data tanpa pagination
    protected function success_list($message = 'Permintaan berhasil diproses', $data = [])
    {
        $response['data'] = $data;
        $response['message'] = $message;
        $response['status'] = SUKSES;
        $response['total_data'] = count($data);

        return response()->json($response);
    }

    // pesan sukses untuk tambah, ubah, hapus
    protected function success_cud($message = 'Permintaan berhasil diproses', $data)
    {
        $response['data'] = $data;
        $response['message'] = $message;
        $response['status'] = SUKSES;

        return response()->json($response);
    }

    // pesan untuk ambil data pagination dari data array
    protected function success_pagination_from_array($message = 'Permintaan berhasil diproses', $data = [], $count_data, $current_page)
    {
        $response['data'] = $data;
        $response['message'] = $message;
        $response['status'] = SUKSES;
        $response['current_page'] = $current_page;
        $response['total_data'] = $count_data;

        return response()->json($response);
    }

    protected function failure($message = 'Permintaan gagal diproses', $data = [], $status = null)
    {
        $status = $status ? $status : GAGAL;
        $response['data'] = $data;
        $response['message'] = $message;
        $response['status'] = $status;

        return response()->json($response, $status);
    }

    protected function notFound($message = 'Data tidak ditemukan', $data = [])
    {
        $response['data'] = $data;
        $response['message'] = $message;
        $response['status'] = DATA_TIDAK_DITEMUKAN;

        return response()->json($response, DATA_TIDAK_DITEMUKAN);
    }

    protected function unauthorized($message = 'Anda tidak memiliki hak akses. Silakan login terlebih dahulu')
    {
        $response['message'] = $message;
        $response['status'] = BELUM_MEMILIKI_HAK_AKSES;

        return response()->json($response, BELUM_MEMILIKI_HAK_AKSES);
    }

    protected function convertUmur($tanggal_lahir = '')
    {
        if (trim($tanggal_lahir) != '') {
            $tahun = Carbon::parse(trim($tanggal_lahir))->diffInYears(Carbon::today()->format('Y-m-d'));
            if ($tahun > 0) {
                $umur = $tahun . ' tahun';
            } else {
                $bulan = Carbon::parse(trim($tanggal_lahir))->diffInMonths(Carbon::today()->format('Y-m-d'));
                if ($bulan > 0) {
                    $umur = $bulan . ' bulan';
                } else {
                    $umur = Carbon::parse(trim($tanggal_lahir))->diffInDays(Carbon::today()->format('Y-m-d'));
                }
            }

            return $umur;
        }

        return trim($tanggal_lahir);
    }

    protected function validateData($data)
    {
        if (is_null($data)) {
            return true;
        }
        return false;
    }

    protected function validateArrayData($data)
    {
        if (empty($data)) {
            return false;
        }
        return true;
    }

    protected function createdBy($input = [])
    {
        $input['operator'] = $input['editor'] = $input['created_by'] = $input['updated_by'] = null;
        $input['tgl_input'] = $input['tgl_update'] = $input['updated'] = date('Y-m-d H:i:s');

        return $input;
    }

    protected function updatedBy($input = [])
    {
        $input['editor'] = $input['updated_by'] = null;
        $input['tgl_update'] = date('Y-m-d H:i:s');

        return $input;
    }

    protected function deletedBy($input = [])
    {
        $input['editor'] = $input['updated_by'] = $input['deleted_by'] = null;
        $input['tgl_update'] = date('Y-m-d H:i:s');

        return $input;
    }

    protected function tanggal_indo($date)
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return date('d', strtotime($date)) . ' ' . $bulan[date('n', strtotime($date))] . ' ' . date('Y', strtotime($date));
    }

    protected function convertBulan($bulan = 0)
    {
        $array_bulan = [
            0 => 'Tidak Terdefinisi',
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $array_bulan[$bulan];
    }

    public function public_path($path = '')
    {
        return env('PUBLIC_PATH', base_path('public')) . ($path ? '/' . $path : $path);
    }

    public function rupiah($angka)
    {
        $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function saveFile($images, $path)
    {
        $file = $images;
        $tujuan_upload = $path;
        $namafile = sha1('course-' . date('Y-m-d-H-i-s') . rand(0, 20));
        $nama_file = $namafile . '.' . $file->getClientOriginalExtension();
        $file->move($tujuan_upload, $nama_file);

        return $nama_file;
    }

    public function replaceFile($oldfile, $images, $path)
    {
        if (File::exists($oldfile)) {
            File::delete($oldfile);
        }
        $file = $images;
        $tujuan_upload = $path;
        $namafile = sha1('course-' . date('Y-m-d-H-i-s') . rand(0, 20));
        $nama_file = $namafile . '.' . $file->getClientOriginalExtension();
        $file->move($tujuan_upload, $nama_file);

        return $nama_file;
    }
}
