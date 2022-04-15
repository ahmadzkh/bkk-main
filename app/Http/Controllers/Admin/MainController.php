<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Admin;
use App\Models\User;
use App\Models\Angkatan;


/**
 * @author Kelompok-3
 * @filesource MainController
 * @description Semua Halaman Dashboard Admin
 */
class MainController extends Controller
{
    protected $adminModel;
    protected $alumniModel;
    protected $userModel;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->adminModel = Admin::first();
        $this->alumniModel = Alumni::all();
        $this->userModel = User::all();
    }

    /**
     * Display a main dashboard admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_alumni = Alumni::count();
        $count_alumniKerja = $this->alumniModel->whereNotNull('kerja_active')->count();
        $count_alumniKuliah = $this->alumniModel->whereNotNull('kuliah_active')->count();
        $count_alumniUsaha = $this->alumniModel->whereNotNull('usaha_active')->count();

        $data_angkatan = Angkatan::orderBy('id_angkatan', 'DESC')->paginate(5);
        $data_alumni = Alumni::all();

        $data = [];

        foreach ($data_angkatan as $angkatan) {
            $data['label'][] = $angkatan->angkatan;
            $data['data'][] = (int) $angkatan->count;
        }

        $data['chart_data'] = json_encode($data);

        // dd($count_alumniKerja);

        return view('admin.dashboard.main', [
            'active' => 'dashboard',
            'count_alumni' => $count_alumni,
            'count_alumniKerja' => $count_alumniKerja,
            'count_alumniKuliah' => $count_alumniKuliah,
            'count_alumniUsaha' => $count_alumniUsaha,
        ], $data);
    }

    /**
     * Display notification for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function notification()
    {
        return view('admin.dashboard.notification');
    }
}