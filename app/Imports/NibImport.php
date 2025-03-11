<?php

namespace App\Imports;

use App\Models\Nib;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class NibImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
            return new Nib([
            'nib' => $row['nib'], // Langsung ambil nilai kolom
            'tanggal_terbit_oss' => $this->parseTanggal($row['tanggal_terbit_oss']),
            'nama_perusahaan' => $row['nama_perusahaan'],
            'status_pm' => $row['status_pm'],
            'jenis_perusahaan' => $row['jenis_perusahaan'],
            'alamat' => $row['alamat'],
            'kelurahan' => $row['kelurahan'],
            'kecamatan' => $row['kecamatan'],
            'kab_kota' => $row['kab_kota'],
            'email' => $row['email'],
            'nomor_telp' => $this->formatNomorTelp($row['nomor_telp'])
        ]);
    }

    private function parseTanggal($value)
    {
        if (empty($value)) return null;

        // Handle format Excel date
        if (is_numeric($value)) {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format('Y-m-d');
        }

        // Handle format teks
        try {
            return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            try {
                return Carbon::parse($value)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }
    }

    private function formatNomorTelp($nomor)
    {
        if (empty($nomor) || $nomor == '-') return null;

        // Bersihkan karakter non-digit
        $cleaned = preg_replace('/[^0-9]/', '', $nomor);

        // Hilangkan leading zero
        return ltrim($cleaned, '0');
    }
}
