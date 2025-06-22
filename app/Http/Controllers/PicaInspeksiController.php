<?php

namespace App\Http\Controllers;

use App\Models\InspeksiComputer;
use App\Models\InspeksiLaptop;
use App\Models\PicaInspeksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use DNS2D;

class PicaInspeksiController extends Controller
{
    public function index($site)
    {
        $sitePharse = $site;
        if ($sitePharse != 'HO') {
            $crew = User::whereIn('role', ['ict_technician', 'ict_group_leader'])->where('site', $sitePharse)->pluck('name')->map(function ($name) {
                return ['name' => $name];
            })->toArray();
        } else {
            $crew = User::whereIn('role', ['ict_ho'])->where('site', 'HO')->pluck('name')->map(function ($name) {
                return ['name' => $name];
            })->toArray();
        }
        // dd($dataPica);
        return Inertia::render('PicaInspeksi/PicaInspeksiIndex', ['site' => $sitePharse, 'crew' => $crew]);
    }

    public function getDataPicaByDevice(Request $request)
    {
        $deviceType = $request->input('device_type');
        $site = (string) $request->input('site');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        if (!$deviceType || !$site) {
            return response()->json(['message' => 'device_type dan site harus dikirim'], 400);
        }

        if ($deviceType === 'Laptop') {
            $query = InspeksiLaptop::where('site', $site)
                ->whereNotNull('findings_image')
                ->whereHas('inventory')
                ->whereHas('inventory.pengguna')
                ->with('inventory.pengguna');

            if ($startDate && $endDate != null) {
                $query->whereBetween('created_date', [$startDate, $endDate]);
            }

            $data = $query->get();
        } elseif ($deviceType === 'Computer') {
            $query = InspeksiComputer::where('site', $site)
                ->whereNotNull('findings_image')
                ->whereHas('computer')
                ->whereHas('computer.pengguna')
                ->with('computer.pengguna');

            if ($startDate && $endDate != null) {
                $query->whereBetween('created_date', [$startDate, $endDate]);
            }

            $data = $query->get();
        } else {
            return response()->json(['message' => 'Invalid device type'], 400);
        }

        return response()->json($data);
    }

    public function edit($id)
    {
        $dataInspeksiLaptop = InspeksiLaptop::find($id);
        $dataInspeksiComputer = InspeksiComputer::find($id);

        if ($dataInspeksiLaptop) {
            $data = InspeksiLaptop::whereHas('inventory')
                ->whereHas('inventory.pengguna')
                ->with('inventory.pengguna')
                ->where('id', $id)->first();

            $data->device_code = $data->inventory->laptop_code ?? '-';
            $data->device_name = $data->inventory->laptop_name ?? '-';
            $data->device_sn = $data->inventory->serial_number ?? '-';
            $data->device_condition = $data->inventory->condition ?? '-';
            $data->device_asset_ho = $data->inventory->number_asset_ho ?? '-';
            $data->device_spesifikasi = $data->inventory->spesifikasi ?? '-';
            $data->device_condition = $data->inventory->condition ?? '-';
            $data->device_status_inventory = $data->inventory->status ?? '-';
            $data->device_note = $data->inventory->note ?? '-';
            $data->device_pengguna = $data->inventory->pengguna->username ?? '-';
            $data->device_dept = $data->inventory->pengguna->department ?? '-';
            $data->device_ip_address = $data->inventory->ip_address ?? '-';
            $data->device_location = $data->inventory->location ?? '-';
            $data->device_type = 'Laptop';
        } else {
            $data = InspeksiComputer::whereHas('computer')
                ->whereHas('computer.pengguna')
                ->with('computer.pengguna')
                ->where('id', $id)->first();

            $data->device_code = $data->computer->computer_code ?? '-';
            $data->device_name = $data->computer->computer_name ?? '-';
            $data->device_sn = $data->computer->serial_number ?? '-';
            $data->device_condition = $data->computer->condition ?? '-';
            $data->device_asset_ho = $data->computer->number_asset_ho ?? '-';
            $data->device_spesifikasi = $data->computer->spesifikasi ?? '-';
            $data->device_condition = $data->computer->condition ?? '-';
            $data->device_status_inventory = $data->computer->status ?? '-';
            $data->device_note = $data->computer->note ?? '-';
            $data->device_pengguna = $data->computer->pengguna->username ?? '-';
            $data->device_dept = $data->computer->pengguna->department ?? '-';
            $data->device_ip_address = $data->computer->ip_address ?? '-';
            $data->device_location = $data->computer->location ?? '-';
            $data->device_type = 'Computer';
        }

        if (!empty($data->inspector)) {

            $inspector = array($data->inspector);
        } else {
            $inspector = array('data tidak ada !');
        }


        $crew = User::whereIn('role', ['ict_technician', 'ict_group_leader'])
            ->where('site', $data->site)
            ->pluck('name')
            ->map(fn ($name) => ['name' => $name])
            ->toArray();

        // dd($inspector);
        return Inertia::render('PicaInspeksi/PicaInspeksiEdit', [
            'site' => $data->site,
            'dataInspeksi' => $data,
            'crew' => $crew,
            'inspector' => $inspector
        ]);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        // dd($params);
        $currentDate = Carbon::now();
        $year = $currentDate->format('Y');

        $data = [
            'findings' => $params['temuan'],
            'findings_action' => $params['tindakan'],
            'due_date' => $params['due_date'],
            'findings_status' => $params['findings_status'],
            'remarks' => $params['remark'],
            'inspector' => $params['inspector'],
            'last_edited_by' => auth()->user()->nrp
        ];

        $dataPica = [
            'inspeksi_id' => $request->id,
            'temuan' => $params['temuan'],
            'tindakan' => $params['tindakan'],
            'due_date' => $params['due_date'],
            'remark' => $params['remark'],
            'status_pica' => $params['findings_status'],
            'close_by' => auth()->user()->name,
            'site' => 'BA',

        ];

        if ($request->file('image_temuan') != null) {
            $document_image = $request->file('image_temuan');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['findings_image'] =  url($new_path_document_image);
            $dataPica['foto_temuan'] =  url($new_path_document_image);
        }

        if ($request->file('image_tindakan') != null) {
            $document_image = $request->file('image_tindakan');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['action_image'] =  url($new_path_document_image);
            $dataPica['foto_tindakan'] =  url($new_path_document_image);
        }

        if ($request->file('image_inspeksi') != null) {
            $document_image = $request->file('image_inspeksi');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['inspection_image'] =  url($new_path_document_image);
        }


        // Update atau create PicaInspeksi
        PicaInspeksi::updateOrCreate(
            ['inspeksi_id' => $request->id],
            $dataPica
        );

        // Coba update InspeksiLaptop
        $laptop = InspeksiLaptop::find($request->id);

        if ($laptop) {
            $laptop->update($data);
        } else {
            // Jika tidak ada di Laptop, coba update InspeksiComputer
            $computer = InspeksiComputer::find($request->id);

            if ($computer) {
                $computer->update($data);
            } else {
                return back()->with('error', 'Data inspeksi tidak ditemukan.');
            }
        }

        return redirect()->route('picaInspeksi.page', ['site' => $dataPica['site']]);
    }

    public function detail($id)
    {
        $dataInspeksiLaptop = InspeksiLaptop::find($id);
        $dataInspeksiComputer = InspeksiComputer::find($id);

        if ($dataInspeksiLaptop) {
            $data = InspeksiLaptop::whereHas('inventory')
                ->whereHas('inventory.pengguna')
                ->with('inventory.pengguna')
                ->where('id', $id)->first();

            $data->device_code = $data->inventory->laptop_code ?? '-';
            $data->device_name = $data->inventory->laptop_name ?? '-';
            $data->device_sn = $data->inventory->serial_number ?? '-';
            $data->device_condition = $data->inventory->condition ?? '-';
            $data->device_asset_ho = $data->inventory->number_asset_ho ?? '-';
            $data->device_spesifikasi = $data->inventory->spesifikasi ?? '-';
            $data->device_condition = $data->inventory->condition ?? '-';
            $data->device_status_inventory = $data->inventory->status ?? '-';
            $data->device_note = $data->inventory->note ?? '-';
            $data->device_pengguna = $data->inventory->pengguna->username ?? '-';
            $data->device_dept = $data->inventory->pengguna->department ?? '-';
            $data->device_ip_address = $data->inventory->ip_address ?? '-';
            $data->device_location = $data->inventory->location ?? '-';
            $data->device_type = 'Laptop';
        } else {
            $data = InspeksiComputer::whereHas('computer')
                ->whereHas('computer.pengguna')
                ->with('computer.pengguna')
                ->where('id', $id)->first();

            $data->device_code = $data->computer->computer_code ?? '-';
            $data->device_name = $data->computer->computer_name ?? '-';
            $data->device_sn = $data->computer->serial_number ?? '-';
            $data->device_condition = $data->computer->condition ?? '-';
            $data->device_asset_ho = $data->computer->number_asset_ho ?? '-';
            $data->device_spesifikasi = $data->computer->spesifikasi ?? '-';
            $data->device_condition = $data->computer->condition ?? '-';
            $data->device_status_inventory = $data->computer->status ?? '-';
            $data->device_note = $data->computer->note ?? '-';
            $data->device_pengguna = $data->computer->pengguna->username ?? '-';
            $data->device_dept = $data->computer->pengguna->department ?? '-';
            $data->device_ip_address = $data->computer->ip_address ?? '-';
            $data->device_location = $data->computer->location ?? '-';
            $data->device_type = 'Computer';
        }

        if (!empty($data->inspector)) {

            $inspector = array($data->inspector);
        } else {
            $inspector = array('data tidak ada !');
        }
        // dd($data);
        return Inertia::render('PicaInspeksi/PicaInspeksiDetail', [
            'dataInspeksi' => $data,
        ]);
    }

    public function exportPdf(Request $request)
    {
        // dd($request);
        // 1. Validasi input
        $validated = $request->validate([
            'device' => 'required|in:Laptop,Computer',
            'site' => 'required|string',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'pic' => 'nullable|string',
        ]);
        if ($request->device == 'Computer') {
            $devicePage = 'COMPUTER'; 
        }else{
            $devicePage = 'LAPTOP'; 
        }
        // 2. Ambil data dari request
        $site = $validated['site'];
        $device = $validated['device'];
        $startDate = $validated['startDate'] ?? null;
        $endDate = $validated['endDate'] ?? null;
        $picName = $validated['pic'] ?? null;

        $startDateConv = $startDate ? Carbon::parse($startDate)->translatedFormat('d F Y') : null;
        $endDateConv = $endDate ? Carbon::parse($endDate)->translatedFormat('d F Y') : null;

        // 3. Ambil data inspeksi berdasarkan device
        $dataPica = $device === 'Computer'
            ? $this->getComputerInspections($site, $startDate, $endDate)
            : $this->getLaptopInspections($site, $startDate, $endDate);

        // 4. Bersihkan path gambar agar lokal dan bisa dibaca oleh DomPDF
        foreach ($dataPica as $item) {
            if ($item->findings_image) {
                $filename = Str::after($item->findings_image, '/images/');
                $item->findings_image = $filename;
            }

            if ($item->action_image) {
                $filename = Str::after($item->action_image, '/images/');
                $item->action_image = $filename;
            }
            // dd($item->findings_image);
        }

        // 5. Cari data yang berstatus "Y" untuk mendapatkan PIC approval
        $inspectionY = $dataPica->firstWhere('inspection_status', 'Y');
        $picApproved = $inspectionY->approved_by ?? null;
        $qr_base64Approved = $picApproved ? $this->generateQrFromUserName($picApproved) : null;

        // 6. Generate QR untuk PIC inspeksi (yang dipilih manual)
        $qr_base64Pic = $picName ? $this->generateQrFromUserName($picName) : null;

        // 7. Generate PDF
        Pdf::setOptions(['isRemoteEnabled' => true]); // <--- WAJIB agar gambar URL bisa muncu

        // 8. Return PDF response
        if ($startDate && $endDate) {
            $pdf = Pdf::loadView('itportal.rekapAllInspeksi.rekapPica', compact(
                'dataPica',
                'site',
                'picName',
                'picApproved',
                'qr_base64Approved',
                'qr_base64Pic',
                'startDateConv',
                'endDateConv',
                'devicePage',
            ))->setPaper('A4', 'landscape');
            return $pdf->stream('Pica-inspection-' . strtolower($device) . '-report-periode' . $startDate . '-' . $endDate . 'pdf');
        } else {
            $year = Carbon::now()->year;
            $pdf = Pdf::loadView('itportal.rekapAllInspeksi.rekapPica', compact(
                'dataPica',
                'site',
                'picName',
                'picApproved',
                'qr_base64Approved',
                'qr_base64Pic',
                'year',
                'devicePage',
            ))->setPaper('A4', 'landscape');
            return $pdf->stream('Pica-inspection-' . strtolower($device) . '-report-periode' . $year . 'pdf');
        }
    }

    private function getComputerInspections($site, $startDate, $endDate)
    {
        $query = InspeksiComputer::with('computer.pengguna')
            ->where('site', $site)
            ->whereNotNull('findings_image');

        if ($startDate && $endDate) {
            $query->whereBetween('created_date', [$startDate, $endDate]);
        } else {
            $query->where('year', Carbon::now()->year);
        }

        return $query->get()->map(function ($item) {
            $spesifikasi = $item->computer->spesifikasi ?? '';
            $item->spesifikasi_singkat = $spesifikasi !== '' ? Str::before($spesifikasi, ',') : '-';
             $item->no_inv = $item->computer->computer_code ?? '-';
             $item->loc = $item->computer->location ?? '-';
            return $item;
        });
    }

    private function getLaptopInspections($site, $startDate, $endDate)
    {
        $query = InspeksiLaptop::with('inventory.pengguna')
            ->where('site', $site)
            ->whereNotNull('findings_image');

        if ($startDate && $endDate) {
            $query->whereBetween('created_date', [$startDate, $endDate]);
        } else {
            $query->where('year', Carbon::now()->year);
        }

        return $query->get()->map(function ($item) {
            $spesifikasi = $item->inventory->spesifikasi ?? '';
            $item->spesifikasi_singkat = $spesifikasi !== '' ? Str::before($spesifikasi, ',') : '-';
             $item->no_inv = $item->inventory->laptop_code ?? '-';
             $item->loc = $item->inventory->location ?? '-';
            return $item;
        });
    }

    private function generateQrFromUserName($name)
    {
        $user = User::where('name', $name)->first();
        if (!$user) return null;

        $qrString = "NRP: {$user->nrp}, Nama: {$user->name}, Jabatan: {$user->position}";
        $barcode = new \Milon\Barcode\DNS2D();
        $barcode->setStorPath(storage_path('framework/barcodes/'));
        $pngData = $barcode->getBarcodePNG($qrString, 'QRCODE');

        return 'data:image/png;base64,' . $pngData;
    }
}
