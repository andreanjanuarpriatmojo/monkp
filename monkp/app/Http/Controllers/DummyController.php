<?php namespace App\Http\Controllers;

use App\User;
use App\Corporation as Perusahaan;
use App\Student;

class DummyController extends Controller {

	public function index()
	{
		$perusahaan = [
			[
				'name' => 'PT. Telkom',
				'address' => 'malang',
				'city' => 'malang',
				'business_type' => 'telekomunikasi',
				'description' => 'telekomunikasi',
			],
			[
				'name' => 'telkomsel',
				'address' => 'jakarta',
				'city' => 'jakarta',
				'business_type' => 'telekomunikasi',
				'description' => 'telekomunikasi',
			],
			[
				'name' => 'winindo',
				'address' => 'jakarta',
				'city' => 'jakarta',
				'business_type' => 'elektronik',
				'description' => 'elektronik',
			],
			[
				'name' => 'pln',
				'address' => 'surabaya',
				'city' => 'surabaya',
				'business_type' => 'listrik',
				'description' => 'listrik',
			],
			[
				'name' => 'pertamina',
				'address' => 'jakarta',
				'city' => 'jakarta',
				'business_type' => 'minyak',
				'description' => 'minyak',
			],
			[
				'name' => 'pgn',
				'address' => 'jakarta',
				'city' => 'jakarta',
				'business_type' => 'gas',
				'description' => 'gas',
			],
			[
				'name' => 'kemendikbud',
				'address' => 'jakarta',
				'city' => 'jakarta',
				'business_type' => 'pendidikan',
				'description' => 'pendidikan',
			],
			[
				'name' => 'gamatekno',
				'address' => 'yogyakarta',
				'city' => 'yogyakarta',
				'business_type' => 'software',
				'description' => 'software',
			],
			[
				'name' => 'jawa Pos',
				'address' => 'surabaya',
				'city' => 'surabaya',
				'business_type' => 'media Massa',
				'description' => 'media Massa',
			],
			[
				'name' => 'teknik Informatika',
				'address' => 'surabaya',
				'city' => 'surabaya',
				'business_type' => 'jurusan',
				'description' => 'jurusan',
			],
			[
				'name' => 'pt. Telkom',
				'address' => 'surabaya',
				'city' => 'surabaya',
				'business_type' => 'telekomunikasi',
				'description' => 'telekomunikasi',
			],
		];

		$students = [
			[
				'nrp' => '5107100050',
				'name' => 'M HAFIIZH FARDHANI'
			],
			[
				'nrp' => '5107100159',
				'name' => 'M. SYAIFULLAH'
			],
			[
				'nrp' => '5108100123',
				'name' => 'PRAMONO ADHI WIDAGDO'
			],
			[
				'nrp' => '5108100139',
				'name' => 'MAULIDAN BAGUS AFRIDIAN RASYID'
			],
			[
				'nrp' => '5109100008',
				'name' => 'HARUN AL RASYID'
			],
			[
				'nrp' => '5109100072',
				'name' => 'SEPTIAWAN ANANDA RIZKI'
			],
			[
				'nrp' => '5109100108',
				'name' => 'ILHAM ZUHRI'
			],
			[
				'nrp' => '5109100148',
				'name' => 'FRADILA OCTA KUSUMA WARDHANI'
			],
			[
				'nrp' => '5109100149',
				'name' => 'FAJAR ILMAN SAPUTRA'
			],
			[
				'nrp' => '5110100043',
				'name' => 'MOHAMAD SATRYO PRAMAHARDI'
			],
			[
				'nrp' => '5110100044',
				'name' => 'ADITHYA AGUNG WINOTO'
			],
			[
				'nrp' => '5110100048',
				'name' => 'ARKHA PAMUNGKAS PUTRA'
			],
			[
				'nrp' => '5110100120',
				'name' => 'SEPTI SARASWATI'
			],
			[
				'nrp' => '5110100127',
				'name' => 'STEFANUS CANDRA KUSUMA WARDANA'
			],
			[
				'nrp' => '5110100133',
				'name' => 'RIZKA NOVIANA INDRIYANI'
			],
			[
				'nrp' => '5110100167',
				'name' => 'RIZQI HIDAYATULLAH'
			],
			[
				'nrp' => '5110100176',
				'name' => 'RIZKI ACHMAD REZHA'
			],
			[
				'nrp' => '5110100185',
				'name' => 'PATTOE MARZA'
			],
			[
				'nrp' => '5110100187',
				'name' => 'ANTONIO CAHYADI L'
			],
			[
				'nrp' => '5110100191',
				'name' => 'MUHAMMAD AGIL M.'
			],
			[
				'nrp' => '5110100707',
				'name' => 'NI`MAL MURSYIDAH'
			],
			[
				'nrp' => '5111100002',
				'name' => 'EKO ADHI WIYONO'
			],
			[
				'nrp' => '5111100004',
				'name' => 'FIRDA AINUR RAMADHANI'
			],
			[
				'nrp' => '5111100005',
				'name' => 'RIMBY KAMESWORO'
			],
			[
				'nrp' => '5111100006',
				'name' => 'ISWAHYUDI'
			],
			[
				'nrp' => '5111100007',
				'name' => 'SULIADI MARSETYA'
			],
			[
				'nrp' => '5111100009',
				'name' => 'SHABRINA CHOIRUNNISA'
			],
			[
				'nrp' => '5111100010',
				'name' => 'MONIKA MAYTRI'
			],
			[
				'nrp' => '5111100011',
				'name' => 'ROSALINA EKA DIANTY'
			],
			[
				'nrp' => '5111100014',
				'name' => 'BAHRUL HALIMI'
			],
			[
				'nrp' => '5111100015',
				'name' => 'NABILLA SABBAHA AUDRIA P'
			],
			[
				'nrp' => '5111100016',
				'name' => 'ADITYA BUDHI DHARMA'
			],
			[
				'nrp' => '5111100017',
				'name' => 'ASTANDRO KOESRIPUTRANTO'
			],
			[
				'nrp' => '5111100018',
				'name' => 'YOGA PRATAMA ALIARHAM'
			],
			[
				'nrp' => '5111100019',
				'name' => 'BUSTAN AMAL A'
			],
			[
				'nrp' => '5111100020',
				'name' => 'AIDA MUFLICHAH'
			],
			[
				'nrp' => '5111100022',
				'name' => 'FIRDAUS NUTRIHADI'
			],
			[
				'nrp' => '5111100024',
				'name' => 'MULIA LOVENDO APRIN CIGY'
			],
			[
				'nrp' => '5111100025',
				'name' => 'WIBY MAHAN FAQIH'
			],
			[
				'nrp' => '5111100026',
				'name' => 'PUTU HARUM BAWA'
			],
			[
				'nrp' => '5111100027',
				'name' => 'WAHYU WIDODO'
			],
			[
				'nrp' => '5111100029',
				'name' => 'RIZKA WAKHIDATUS SHOLIKAH'
			],
			[
				'nrp' => '5111100031',
				'name' => 'HELMY SATRIA MARTHA PUTRA'
			],
			[
				'nrp' => '5111100032',
				'name' => 'GALIH PUTERA NUGRAHA S'
			],
			[
				'nrp' => '5111100033',
				'name' => 'FEBRY AMIN NURHIDAYAH'
			],
			[
				'nrp' => '5111100034',
				'name' => 'ZULFAH PERMATA I'
			],
			[
				'nrp' => '5111100036',
				'name' => 'ANJAR MUSTIKA'
			],
			[
				'nrp' => '5111100037',
				'name' => 'MADE DIA AGUSTYA'
			],
			[
				'nrp' => '5111100038',
				'name' => 'NOVITA NATA WARDANIE'
			],
			[
				'nrp' => '5111100041',
				'name' => 'MENTARI QUEEN GLOSSYTA'
			],
			[
				'nrp' => '5111100042',
				'name' => 'MUHAMMAD IMADUDDIN'
			],
			[
				'nrp' => '5111100043',
				'name' => 'MUHAMAD ROHMAN'
			],
			[
				'nrp' => '5111100044',
				'name' => 'DHIMAS BAGUS PRAMUDYA'
			],
			[
				'nrp' => '5111100045',
				'name' => 'MAHENDRA HARSA WARDHANA'
			],
			[
				'nrp' => '5111100046',
				'name' => 'NAFI LAKSMANA DIRGAYUSA'
			],
			[
				'nrp' => '5111100047',
				'name' => 'I GUSTI NGURAH DESTA RIMBAWAN'
			],
			[
				'nrp' => '5111100050',
				'name' => 'TOMMY NURWANTORO'
			],
			[
				'nrp' => '5111100051',
				'name' => 'USWATUN HASANA KUNIO'
			],
			[
				'nrp' => '5111100052',
				'name' => 'MAHARDHIKA MAULANA'
			],
			[
				'nrp' => '5111100053',
				'name' => 'WILIK'
			],
			[
				'nrp' => '5111100055',
				'name' => 'ARUNDIN ARNENDYA P'
			],
			[
				'nrp' => '5111100057',
				'name' => 'AHMAD FAUZI AL WAHID'
			],
			[
				'nrp' => '5111100058',
				'name' => 'STIEVEN WIRAKASA'
			],
			[
				'nrp' => '5111100060',
				'name' => 'STEVEN FREDIAN A.P.'
			],
			[
				'nrp' => '5111100065',
				'name' => 'ASRI AYU DIANI PUTRI'
			],
			[
				'nrp' => '5111100066',
				'name' => 'INDRA SAPUTRA'
			],
			[
				'nrp' => '5111100068',
				'name' => 'M. CHAQIQI MUDAFI'
			],
			[
				'nrp' => '5111100069',
				'name' => 'RIZALDI TRI YANUAR'
			],
			[
				'nrp' => '5111100070',
				'name' => 'KHARISMA ALIVIA N'
			],
			[
				'nrp' => '5111100071',
				'name' => 'MOHAMMAD APRIALDI RIZKY PRATAMA'
			],
			[
				'nrp' => '5111100073',
				'name' => 'KARSONO PUGUH NINDYO CIPTO'
			],
			[
				'nrp' => '5111100074',
				'name' => 'EBENHAEZER W.Y'
			],
			[
				'nrp' => '5111100075',
				'name' => 'FAIKHA RIZQI AZIZA'
			],
			[
				'nrp' => '5111100076',
				'name' => 'SINDUNURAGA RIKARNO PUTRA'
			],
			[
				'nrp' => '5111100078',
				'name' => 'ERLANGGA KRISNAMUKTI'
			],
			[
				'nrp' => '5111100079',
				'name' => 'MUHAMMAD YUNUS BAHARI'
			],
			[
				'nrp' => '5111100080',
				'name' => 'NOVANDI BANITAMA'
			],
			[
				'nrp' => '5111100081',
				'name' => 'ANDRIE PRASETYO UTOMO'
			],
			[
				'nrp' => '5111100082',
				'name' => 'HILMAN W SIAHAAN'
			],
			[
				'nrp' => '5111100083',
				'name' => 'SANDHI ADING WASANA'
			],
			[
				'nrp' => '5111100084',
				'name' => 'I GUSTI KETUT ANOM'
			],
			[
				'nrp' => '5111100085',
				'name' => 'WIDYASARI AYU WIBOWO'
			],
			[
				'nrp' => '5111100087',
				'name' => 'AKHMAD BAKHRUL ILMI'
			],
			[
				'nrp' => '5111100089',
				'name' => 'ANNISA ARUM MUMTAZAH'
			],
			[
				'nrp' => '5111100090',
				'name' => 'SEPTY RETNO WULAN'
			],
			[
				'nrp' => '5111100091',
				'name' => 'AHMAD HAYAM BRILIAN'
			],
			[
				'nrp' => '5111100092',
				'name' => 'SANDY AKBAR DEWANGGA'
			],
			[
				'nrp' => '5111100093',
				'name' => 'LUCKY FANDIJANTO JOEWONO'
			],
			[
				'nrp' => '5111100094',
				'name' => 'UMA PATU RAMA'
			],
			[
				'nrp' => '5111100095',
				'name' => 'ANDY WILLIAM'
			],
			[
				'nrp' => '5111100096',
				'name' => 'DIMAS RANGGA F'
			],
			[
				'nrp' => '5111100097',
				'name' => 'BASKARA NUR PATRIA'
			],
			[
				'nrp' => '5111100098',
				'name' => 'IFAN IQBAL'
			],
		];

		foreach ($perusahaan as $p) {
			Perusahaan::firstOrCreate($p);
		}

		foreach ($students as $s) {
			$student = new Student();
			$student->nrp = $s['nrp'];
			$student->name = $s['name'];
			$student->save();

			$user = new User();
			$user->username = $s['nrp'];
			$user->password = bcrypt('1');

			$user->personable_id = $student->id;
			$user->personable_type = 'student';
			$user->save();
		}
	}

}
