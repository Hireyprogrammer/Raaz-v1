<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

use App\Models\Backend\AuthModel;
use App\Models\Backend\DashboardModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // $printer = new Printer(new WindowsPrintConnector('MP-POS58'));
        // $printer->close();

        //return ('Admin Dashboard');
        $auth = new AuthModel(); 
        $dash =  new DashboardModel();
        // if (session()->get('user')['pos_user'] == 1) {
        //     return redirect()->to(base_url($this->viewData['locale']) . '/pos/point_of_sale');
        // }

        // $role = session()->get('user')['ut_id'];
        // if ($role !== "1") {
        //     $this->viewData['access'] = $auth->get_user_access(session()->get('ut_id'), $this->request->getLocale());

        //     $this->viewData['no_employee'] = $dash->get_no_employees();
        //     $this->viewData['no_products'] = $dash->get_no_products();
        //     $this->viewData['no_customers'] = $dash->get_no_customers();
        //     $this->viewData['no_suppliers'] = $dash->get_no_suppliers();

        //     return view('admin/nonadmin_dash', $this->viewData);
        // } 
        $this->viewData['count_stock'] = $dash->get_stock_counts();
        $this->viewData['stock_alert'] = $dash->get_stockalert__counts();
        // $this->viewData['total_receivable'] = $dash->get_total_receivable();
        $this->viewData['last_sales'] = $dash->get_last_sales();
        $this->viewData['waiters'] = $dash->get_waiters_list();
        $this->viewData['no_clients'] = $dash->get_no_clients();
        $this->viewData['netProfit'] = $dash->get_netProfit_value();
        $this->viewData['today_Sales'] = $dash->get_today_netProfit_value();
        $this->viewData['stock_value'] = $dash->get_stock_value();
        $this->viewData['income_expenses'] = $dash->expenses_income_calculator();

        $this->viewData['prod_per_sales'] = $dash->get_product_sales_percentage();
        

        $this->viewData['access'] = $auth->get_user_access(session()->get('ut_id'), $this->request->getLocale());
        return view('admin/dashboard', $this->viewData);



    }

    public function sales_by_waiters(){
        $value= $this->request->getVar('value');
        $dash = new DashboardModel();
        $data = $dash->waiter_percentage($value);
        return json_encode(['data'=>$data['values'], 'labels'=>$data['labels']]);
    }

    // public function index(): string
    // {
    //     $auth = new AuthModel();
    //     $dashoard = new DashboardModel();

       
    //     $this->viewData['halls'] = $this->get_table_with_branch('tbl_halls');
    //     $this->viewData['tenants'] = $this->get_table_with_branch('tbl_customers');
        
    //     $this->viewData['income'] = $dashoard->get_pos_income();
    //     $this->viewData['income_month'] =$dashoard->get_pos_income_monthly();
        
    //     $this->viewData['active_booking'] = $dashoard->get_booking_count('Active');
    //     $this->viewData['comp_booking'] = $dashoard->get_booking_count('Booked');
    //     $this->viewData['cancel_booking'] = $dashoard->get_booking_count('Cancelled');
                
    //     $this->viewData['expense'] = $dashoard->get_daily_expenses();
    //     $this->viewData['expense_month'] = $dashoard->get_monthly_expenses();
        
    //     $this->viewData['payables'] =  $dashoard->get_total_payables();
    //     $this->viewData['receivables'] = $dashoard->get_total_receivables();
    
        
    //     $this->viewData['monthly_rev'] =  $dashoard->get_monthly_revenue();

    //     $this->viewData['access'] = $auth->get_user_access(session()->get('ut_id'),$this->request->getLocale());
    //     return view('admin/dashboard', $this->viewData);

    // }


   

    // ================================== VAT ====================================
  
    public function vat(){
        $auth = new AuthModel();
        $this->viewData['access'] = $auth->get_user_access(session()->get('ut_id'), $this->request->getLocale());

        return view("admin/vat", $this->viewData);
    }

 
    public function get_vat()
    {
        $auth = new AuthModel();
        $result = array('data' => array());
        $data = $auth->db->query("SELECT * from vat_table")->getResultArray();
        $i = 1;
        foreach ($data as $key => $value) {

            $buttons = '';
            $btn = [
                'header' => '<div class="ml-auto">
                            <div class="dropdown sub-dropdown"><button class="btn btn-link text-dark" type="button"
                            id="dd1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-ellipsis-v mx-1"></i></button><div class="dropdown-menu dropdown-menu-right" 
                            aria-labelledby="dd1" x-placement="bottom-end" style="position: absolute; will-change: transform; 
                            top: 0px; left: 0px; transform: translate3d(-110px, 39px, 0px);">
                ',
                'mid_1' => '',
            ];
            $set = [
                'id' => $value["id"],
                'rec_title' => "VAT",
                'status' => $value["status"],
                'rec_tbl' => 'vat_table',
                'rec_tag_col' => 'status',
                'rec_id_col' => 'id',
            ];

            $act = ($set["status"] == 'Pending' || $set["status"] == 'Blocked') ? '' : 'hidden';
            $block = ($set["status"] == 'Active') ? '' : 'hidden';
            $delete = '';

            $stat_icon = $this->stat_icon($set["status"]);

            $buttons = $btn['header'] . '
                        
                            <a type="button" id="btn_edit"  data-percentage="' . $value["vat_percentage"] . '"
                            data-id="' . $value["id"] . '"
                            class="dropdown-item" data-bs-toggle="modal" data-bs-target="#vat_modal">
                            <i class="fas fa-pencil-alt text-warning mx-1"></i>' . lang("Site.button.edit") . ' </a>
                                            
                            <a ' . $act . '  type="button" data-rec_id="' . $set["id"] . '" 
                                data-rec_title="' . $set["rec_title"] . '" data-rec_tag="Active"  data-rec_tbl="' . $set["rec_tbl"] . '"
                                data-rec_tag_col="' . $set["rec_tag_col"] . '" data-rec_id_col="' . $set["rec_id_col"] . '"
                                class="dropdown-item" data-bs-toggle="modal" data-bs-target="#status_modal">
                                <i class="fas fa-check text-success mx-1"></i>' . lang('Site.button.activate') . '  
                            </a>
                            <a ' . $block . '  type="button" data-rec_id="' . $set["id"] . '" 
                                data-rec_title="' . $set["rec_title"] . '" data-rec_tag="Blocked" data-rec_tbl="' . $set["rec_tbl"] . '"  
                                data-rec_tag_col="' . $set["rec_tag_col"] . '" data-rec_id_col="' . $set["rec_id_col"] . '"
                                class="dropdown-item" data-bs-toggle="modal" data-bs-target="#status_modal">
                                <i class="fas fa-ban text-danger mx-1"></i>' . lang('Site.button.block') . '  
                            </a>
                      </div>
                    </div>
            </div>';

            $result['data'][$key] = array(
                $i,
                "VAT",
                $value['vat_percentage'] . " %",
                $stat_icon . ' ' . $value['status'],
                $buttons,
            );
            $i++;
        } // /foreach
        // print_r($result);
        echo json_encode($result);
    }

    public function crud_vat(){
        $model = new AuthModel();
        $model->transStart();
        $model->transException(true);
        $response = array();
        $response['success'] = false;
        $response['message'] = 'Updating Vat...';
        $vat_id = $this->request->getVar('vat_id');
        if($vat_id != '' && !is_null($vat_id)){
            $data = [
                'id'=>$vat_id,
                'vat_percentage'=>$this->request->getVar('vat_percentage')
            ];
            $model->db->table('vat_table')->upsert($data);
            if($model->db->transStatus()==false){
                $model->db->transRollback();
                $response['success'] = false;
                $response['message'] = 'failed error Occured';
                echo json_encode($response);
                return;
            }
            $model->db->transCommit();
            $response['success'] = true;
            $response['message'] = 'Successfuly updated VAT';
            echo json_encode($response);
            return;

        }else{
            $vat = $model->db->query("SELECT * from vat_table order by id desc limit 1")->getRow();
            if(!is_null($vat)){
                $data = [
                    'id'=>$vat->id,
                    'vat_percentage'=>$this->request->getVar('vat_percentage')
                ];
                $model->db->table('vat_table')->upsert($data);
                if($model->db->transStatus()==false){
                    $model->db->transRollback();
                    $response['success'] = false;
                    $response['message'] = 'failed error Occured';
                    echo json_encode($response);
                    return;
                }
                $model->db->transCommit();
                $response['success'] = true;
                $response['message'] = 'Successfuly updated VAT';
                echo json_encode($response);
                return;
            }
        }
    }




    # ************************************** PRINTER ***************************************************** #
    public function printers(){
        $auth = new AuthModel();
        $this->viewData['access'] = $auth->get_user_access(session()->get('ut_id'), $this->request->getLocale());

        return view("admin/printers", $this->viewData);
    }

 
    public function get_printer()
    {
        $auth = new AuthModel();
        $result = array('data' => array());
        $data = $auth->db->query("SELECT * from printer_table")->getResultArray();
        $i = 1;
        foreach ($data as $key => $value) {

            $buttons = '';
            $btn = [
                'header' => '<div class="ml-auto">
                            <div class="dropdown sub-dropdown"><button class="btn btn-link text-dark" type="button"
                            id="dd1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-ellipsis-v mx-1"></i></button><div class="dropdown-menu dropdown-menu-right" 
                            aria-labelledby="dd1" x-placement="bottom-end" style="position: absolute; will-change: transform; 
                            top: 0px; left: 0px; transform: translate3d(-110px, 39px, 0px);">
                ',
                'mid_1' => '',
            ];
            $set = [
                'printer_id' => $value["printer_id"],
                'rec_title' => "PRINTER",
                'status' => $value["status"],
                'rec_tbl' => 'printer_table',
                'rec_tag_col' => 'status',
                'rec_id_col' => 'id',
            ];

            $act = ($set["status"] == 'Pending' || $set["status"] == 'Blocked') ? '' : 'hidden';
            $block = ($set["status"] == 'Active') ? '' : 'hidden';
            $delete = '';

            $stat_icon = $this->stat_icon($set["status"]);

            $buttons = $btn['header'] . '
                        
                            <a type="button" id="btn_edit"  
                            data-printer_id="' . $value["printer_id"] . '"
                            data-printer_name="' . $value["printer_name"] . '"
                            class="dropdown-item" data-bs-toggle="modal" data-bs-target="#printer_modal">
                            <i class="fas fa-pencil-alt text-warning mx-1"></i>' . lang("Site.button.edit") . ' </a>
                                            
                            <a ' . $act . '  type="button" data-rec_id="' . $set["printer_id"] . '" 
                                data-rec_title="' . $set["rec_title"] . '" data-rec_tag="Active"  data-rec_tbl="' . $set["rec_tbl"] . '"
                                data-rec_tag_col="' . $set["rec_tag_col"] . '" data-rec_id_col="' . $set["rec_id_col"] . '"
                                class="dropdown-item" data-bs-toggle="modal" data-bs-target="#status_modal">
                                <i class="fas fa-check text-success mx-1"></i>' . lang('Site.button.activate') . '  
                            </a>
                            <a ' . $block . '  type="button" data-rec_id="' . $set["printer_id"] . '" 
                                data-rec_title="' . $set["rec_title"] . '" data-rec_tag="Blocked" data-rec_tbl="' . $set["rec_tbl"] . '"  
                                data-rec_tag_col="' . $set["rec_tag_col"] . '" data-rec_id_col="' . $set["rec_id_col"] . '"
                                class="dropdown-item" data-bs-toggle="modal" data-bs-target="#status_modal">
                                <i class="fas fa-ban text-danger mx-1"></i>' . lang('Site.button.block') . '  
                            </a>
                      </div>
                    </div>
            </div>';

            $result['data'][$key] = array(
                $i,
                $value['printer_name'],
                $stat_icon . ' ' . $value['status'],
                $buttons,
            );
            $i++;
        } // /foreach
        // print_r($result);
        echo json_encode($result);
    }

    public function crud_printer(){
        $model = new AuthModel();
        $model->transStart();
        $model->transException(true);
        $response = array();
        $response['success'] = false;
        $response['message'] = 'Updating Printer Name...';
        $printer_id  = $this->request->getVar('printer_id');
        if($printer_id  != '' && !is_null($printer_id )){
            $data = [
                'printer_id'=>$printer_id,
                'printer_name'=>$this->request->getVar('printer_name')
            ];
            $model->db->table('printer_table')->upsert($data);
            if($model->db->transStatus()==false){
                $model->db->transRollback();
                $response['success'] = false;
                $response['message'] = 'failed error Occured';
                echo json_encode($response);
                return;
            }
            $model->db->transCommit();
            $response['success'] = true;
            $response['message'] = 'Successfuly updated Printer Name';
            echo json_encode($response);
            return;

        }else{
            $printer = $model->db->query("SELECT * from printer_table order by printer_id  desc limit 1")->getRow();
            if(!is_null($printer)){
                $data = [
                    'printer_id'=>$printer->printer_id ,
                    'printer_name'=>$this->request->getVar('printer_name')
                    
                ];
                $model->db->table('printer_table')->upsert($data);
                if($model->db->transStatus()==false){
                    $model->db->transRollback();
                    $response['success'] = false;
                    $response['message'] = 'failed error Occured';
                    echo json_encode($response);
                    return;
                }
                $model->db->transCommit();
                $response['success'] = true;
                $response['message'] = 'Successfuly updated printer name';
                echo json_encode($response);
                return;
            }
        }
    }


}
