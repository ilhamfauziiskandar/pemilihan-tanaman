<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Alternatifmodel;

class Alternatif extends BaseController
{

  protected $Alternatifmodel;
  
  public function __construct()
  {
    
    $this->Alternatifmodel = new Alternatifmodel();

  }

  public function index()
  {
    if (session()->get('username')=='') {
    
      session()->setFlashData('danger','MAAF AKSES DI TOLAK');
      return redirect()->to(base_url('login'));
    
    }
    
    $data=
    [
      'title'=> 'Alternatif',
      'isi' => 'alternatif',
      'kriteria' => $this->Alternatifmodel->get_alternatif()
    ];
    echo view('layout/content',$data);
  }

  public function edit_data_produksi($id_produksi){
    
    $data =
    [
      'hasil' => $this->request->getPost('hasil')
    ];

    $this->Alternatifmodel->edit_produksi($data, $id_produksi);

    $semua = $this->Alternatifmodel->get_produksi();
    
    for ($i=0; $i <= 4; $i++) { 

      $semua[$i]['id_preferensi'] = $i+1;
      
    }

    $data1 = [
     
       [
          'id_produksi' => $semua[0]['id_produksi'],
          'id_preferensi'  => $semua[0]['id_preferensi']
       ],
       [
          'id_produksi' => $semua[1]['id_produksi'],
          'id_preferensi'  => $semua[1]['id_preferensi'] 

       ],
       [
          'id_produksi' => $semua[2]['id_produksi'],
          'id_preferensi'  => $semua[2]['id_preferensi'] 
          
       ],
       [
          'id_produksi' => $semua[3]['id_produksi'],
          'id_preferensi'  => $semua[3]['id_preferensi'] 
       
       ],
       [
          'id_produksi' => $semua[4]['id_produksi'],
          'id_preferensi'  => $semua[4]['id_preferensi'] 
       
       ]
    ];

    for ($a=0; $a <= 4; $a++) { 
    
      $isi = $data1[$a];
    
      $id_produksi1 = $data1[$a]['id_produksi'];
    
      $this->Alternatifmodel->edit_preferensi($isi, $id_produksi1);

    }

    session()->setFlashdata('success','Data berhasil diupdate');

    return redirect()->to(base_url('alternatif'));

  }

  public function delete_data_produksi($id_produksi){

    $this->Alternatifmodel->delete_produksi($id_produksi);

    session()->setFlashdata('success','Data berhasil dihapus');

    return redirect()->to(base_url('alternatif'));
  
  }

}