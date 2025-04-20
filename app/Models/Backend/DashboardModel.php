<?php

namespace App\Models\Backend;
use CodeIgniter\Model;

class DashboardModel extends Model
{


        public function waiter_percentage($waiterId)
        {

            $sql = "SELECT
    w.waiter_name AS waiter,  -- Waiter ID from tbl_orders
    COUNT(od.item_id) AS TotalSales,
    ROUND((COUNT(od.item_id) / total_sales.total) * 100, 2) AS SalesPercentage
FROM
    tbl_order_details od
JOIN tbl_orders o ON od.order_id = o.order_id 
JOIN tbl_products p ON od.item_id = p.product_id 
JOIN tbl_waiters w on w.waiter_id = o.staff_id 
JOIN (
    SELECT COUNT(*) AS total
    FROM tbl_order_details od
    JOIN tbl_orders o ON od.order_id = o.order_id  
    WHERE o.staff_id = $waiterId
) AS total_sales ON 1 = 1
WHERE
    o.staff_id = $waiterId
GROUP BY
    o.staff_id  
ORDER BY
    SalesPercentage DESC;";

            $data = $this->db->query($sql)->getResultArray();

            $labels = [];
            $values = [];

            foreach ($data as $row) {
                $labels[] = $row['waiter'];
                $values[] = (int) $row['SalesPercentage'];
            }

            // Pass data to the view or use as needed
            $data = [
                'labels' => $labels,
                'values' => $values
            ];
            return $data;
        }

    public function get_stock_counts()
    {
        return 0;
        $query = $this->db->query("SELECT sum(stock_level_qty) stock FROM tbl_stock_levels WHERE 1;");
        return $query->getRow()->stock;
    }
    public function get_stockalert__counts()
    {
        return 0;
        $query = $this->db->query("SELECT COUNT(*) as stock_alert_count FROM tbl_products p
                                   JOIN tbl_stock_levels s ON p.product_id = s.product_id
                                    WHERE s.stock_level_qty <= p.stock_limit;");
        return $query->getRow()->stock_alert_count;
    }
    public function get_last_sales()
    {
        // return [];
        // return $this->db->query("SELECT s.*,b.br_name from tbl_sales s join tbl_branches b on b.branch_id=s.branch_id order by sales_id desc limit 10")->getResultArray();
        return $this->db->query("SELECT o.*,b.br_name from tbl_orders o join tbl_branches b on b.branch_id=o.branch_id where o.status='Completed' order by order_id desc limit 5;;")->getResultArray();
    }
    public function get_waiters_list()
    {
        // return [];
        // return $this->db->query("SELECT * from tbl_product_category where parent_id=0 and pro_cat_status='Active'")->getResultArray();
        return $this->db->query("SELECT * from tbl_waiters where waiter_status='Active'")->getResultArray();
    }
    public function get_no_clients()
    {
        // return 0;
        return $this->db->query("SELECT count(*) as total from tbl_customers where cust_status='Active'")->getRow()->total;
    }
 

    // This is For Top Selling Meals
    public function get_product_sales_percentage()
    {

        // $data = ['names' => [], 'total_sales' => [], 'others' => ''];
        // return $data;

        // $sql = "SELECT
        //         p.pro_name,
        //         COUNT(det_id) AS sales_count,
        //         ROUND((COUNT(det_id) / total_orders * 100), 2) AS order_percentage
        //     FROM
        //         tbl_sales_details so join tbl_products p on so.product_id = p.product_id,
        //         (SELECT COUNT(det_id) AS total_orders FROM tbl_sales_details) AS total
                
        //     GROUP BY
        //         so.product_id
        //     ORDER BY
        //         sales_count DESC
        //     LIMIT 10;";
        // $sql = "SELECT p.pro_name, COUNT(od.det_id) AS sales_count, ROUND((COUNT(od.det_id) / total_orders.total_orders * 100), 2) AS order_percentage FROM tbl_order_details od JOIN tbl_products p ON od.item_id = p.product_id JOIN (SELECT COUNT(det_id) AS total_orders FROM tbl_order_details) AS total_orders ON 1 = 1 
        //         GROUP BY od.item_id, p.pro_name ORDER BY sales_count DESC LIMIT 10;";
        $sql = "SELECT p.pro_name, COUNT(od.det_id) AS sales_count, ROUND((COUNT(od.det_id) / total_orders.total_orders * 100), 2) AS order_percentage 
                FROM tbl_order_details od JOIN tbl_products p ON od.item_id = p.product_id JOIN (SELECT COUNT(det_id) AS total_orders FROM tbl_order_details) AS total_orders ON 1 = 1 
                join tbl_orders o on o.order_id = od.order_id where o.status != 'Canceled' GROUP BY od.item_id, p.pro_name ORDER BY sales_count DESC LIMIT 10;";

        $result = $this->db->query($sql)->getResultArray();
        $total_sales = [];
        $prod_names = [];


        foreach ($result as $data) {
            array_push($total_sales, $data['order_percentage']);
            array_push($prod_names, $data['pro_name']);
        }
        // dd(array_sum($total_sales));
        $others = 100 - array_sum($total_sales);
        $data = ['names' => $prod_names, 'total_sales' => $total_sales, 'others' => $others];
        return $data;
    }

    public function get_stock_value()
    {
        // return 0;
        return $this->db->query("SELECT acc_balance from tbl_cl_accounts where acc_tag='IS'")->getRow()->acc_balance;
    }

    public function get_netProfit_value()
    {
        // return 0;
        return $this->db->query("SELECT acc_balance from tbl_cl_accounts where acc_tag='INC'")->getRow()->acc_balance;
    }

    public function get_today_netProfit_value()
    {
        // return 0;
        return $this->db->query("SELECT SUM(b.grand_total) AS Total_Amount FROM tbl_orders b WHERE b.status = 'Completed' AND DATE(b.order_date) = CURDATE() GROUP BY b.order_id")->getRow()->Total_Amount ?? 0.00;
    }

    public function expenses_income_calculator()
    {

        $sql_exp = "SELECT sum(atd.dr_amount) - sum(atd.cr_amount) as total, DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%Y') AS year,
        DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%M') AS month_name from tbl_cl_trans_details atd
        join tbl_cl_accounts acc on acc.account_id = atd.account_id join tbl_cl_account_types att on  att.acc_type_id = acc.acc_type_id 
         AND acc.acc_status='Active' 
        AND att.acc_type_tag='EXP'
        and YEAR(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d')) = YEAR(CURDATE())
        Group By 
            DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%Y'),
            DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%m')
        ORDER BY
            DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%Y'),
            DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%m');";

        $expensesData = $this->db->query($sql_exp)->getResultArray();

        $sql = "SELECT sum(atd.cr_amount) - sum(atd.dr_amount)  as total,  DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%Y') AS year,
                    DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%M') AS month_name from tbl_cl_trans_details atd
                    join tbl_cl_accounts acc on acc.account_id = atd.account_id join tbl_cl_account_types att on  att.acc_type_id = acc.acc_type_id 
                     AND acc.acc_status='Active' 
                    AND att.acc_type_tag='INC'
                    and YEAR(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d')) = YEAR(CURDATE())
                    Group By 
                        DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%Y'),
                        DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%m')
                    ORDER BY
                        DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%Y'),
                        DATE_FORMAT(STR_TO_DATE(atd.trx_det_timestamp, '%Y-%m-%d'), '%m');";

        $incomeData = $this->db->query($sql)->getResultArray();


        $allMonths = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        // Initialize arrays
        $labels = $expenses = $income = array_fill(0, 12, 0);

        // Fill in data
        foreach ($allMonths as $index => $month) {
            $labels[$index] = $month;

            // Check if the month exists in the income data
            $incomeValue = array_search($month, array_column($incomeData, 'month_name'));
            $income[$index] = ($incomeValue !== false) ? $incomeData[$incomeValue]['total'] : 0;

            // Check if the month exists in the expenses data
            $expenseValue = array_search($month, array_column($expensesData, 'month_name'));
            $expenses[$index] = ($expenseValue !== false) ? $expensesData[$expenseValue]['total'] : 0;
        }

        return [$labels, $expenses, $income];



    }
    public function get_table_data($table)
    {

        $query = $this->db->query("SELECT * FROM $table WHERE 1");

        return $query->getNumRows();
    }

    public function get_income_exp($table, $tag)
    {
        // $profile = $this->session->userdata("profile")['profile_no'];
        $query = $this->db->query("SELECT acc_balance FROM $table WHERE acc_tag='$tag'");
        return $query->getRow()->acc_balance ?? 0;
    }
    public function get_daily_expenses()
    {
        //$pno = $this->session->userdata("profile")['profile_no'];
        // $query = $this->db->query("SELECT sum(acc_balance) total FROM tbl_cl_accounts acc
        // JOIN tbl_cl_account_groups grp ON grp.acc_grp_id=acc.acc_grp_id WHERE grp.acc_grp_name='Expenses'");

        $exp = $this->db->query("SELECT sum(exp_cost) total FROM tbl_expenses WHERE exp_date = CURDATE() ")->getRow()->total ?? 0;
        $inv = $this->db->query("SELECT sum(amount) total FROM tbl_supplier_invoices WHERE inv_date =CURDATE() ")->getRow()->total ?? 0;

        return ($exp + $inv);
    }

    public function get_monthly_expenses()
    {

        $exp = $this->db->query("SELECT sum(exp_cost) total FROM tbl_expenses WHERE exp_date >= CURDATE() - INTERVAL 30 DAY")->getRow()->total ?? 0;
        $inv = $this->db->query("SELECT sum(amount) total FROM `tbl_supplier_invoices` WHERE inv_date >= CURDATE() - INTERVAL 30 DAY")->getRow()->total ?? 0;

        return ($exp + $inv);
    }

    public function get_booking_count($st)
    {
        //  bookings 
        $brid = session()->get('user')['branch_id'];
        $booking = $this->db->query("SELECT COUNT(booking_id) book_count FROM tbl_hall_booking WHERE booking_status='$st' and branch_id='$brid'")->getRow()->book_count ?? 0;
        return ($booking);
    }

    public function get_pos_income()
    {
        $brid = session()->get('user')['branch_id'];
        $date = date('Y-m-d');
        $charges = $this->db->query("SELECT SUM(price * qty) total FROM tbl_order_details dt JOIN tbl_orders b ON dt.order_id=b.order_id
        WHERE b.order_date='$date' and b.status='Completed' and branch_id='$brid'")->getRow()->total ?? 0;
        return ($charges);
    }

    public function total_cash()
    {
        $query = $this->db->query("SELECT sum(acc_balance) total FROM tbl_cl_accounts acc JOIN tbl_cl_account_types tp ON tp.acc_type_id=acc.acc_type_id
        WHERE tp.acc_type_tag='CB'");
        return $query->getRow()->total;
    }

    public function get_cash_accounts()
    {

        $query = $this->db->query("SELECT acc_balance, acc_name FROM tbl_cl_accounts acc JOIN tbl_cl_account_types tp ON tp.acc_type_id=acc.acc_type_id
        WHERE tp.acc_type_tag='CB'");
        return $query->getResultArray();
    }

    public function get_pos_income_monthly()
    {
        //  bookings 
        $brid = session()->get('user')['branch_id'];
        $charges = $this->db->query("SELECT SUM(price * qty) total FROM tbl_order_details dt JOIN tbl_orders b ON dt.order_id=b.order_id
        WHERE b.status='Completed' and branch_id='$brid' AND order_date >= CURDATE() - INTERVAL 30 DAY")->getRow()->total ?? 0;
        return $charges;
    }

    public function get_bookings()
    {
        //  bookings 
        $booking = $this->db->query("SELECT count(booking_id) cnt FROM `tbl_hall_booking`")->getRow()->cnt;
        return $booking;
    }

    public function get_rentings()
    {
        $renting = $this->db->query("SELECT count(rent_id) cnt FROM `tbl_rent_booking`")->getRow()->cnt;
        return $renting;
    }


    public function get_total_receivables()
    {
        $brid = session()->get('user')['branch_id'];

        $query = $this->db->query("SELECT sum(acc_balance) total FROM tbl_cl_accounts acc
         JOIN tbl_cl_account_types tp ON tp.acc_type_id=acc.acc_type_id join tbl_customers cu on cu.customer_id=acc.acc_tag
         WHERE tp.acc_type_tag='AR' and cu.branch_id='$brid' and acc.acc_set='Customer'");
        return $query->getRow()->total;
    }

    public function get_total_payables()
    {
        $brid = session()->get('user')['branch_id'];
        // $total = $this->db->query("SELECT SUM(balance) total FROM tbl_supplier_invoices inv 
        // join tbl_suppliers sp on sp.sup_id=inv.sup_id WHERE sp.branch_id='$brid' ")->getRow()->total;
        $query = $this->db->query("SELECT sum(acc_balance) total FROM tbl_cl_accounts acc
        JOIN tbl_cl_account_types tp ON tp.acc_type_id=acc.acc_type_id join tbl_suppliers cu on cu.sup_id=acc.acc_tag
        WHERE tp.acc_type_tag='EXP' and cu.branch_id='$brid' and acc.acc_set='Customer'");
        return $query->getRow()->total;
        return $total;
    }

    public function get_order_counts($status)
    {
        $order = $this->db->query("SELECT count(id) cnt FROM tbl_baskets WHERE basket_status='$status'")->getRow()->cnt;
        return $order;
    }

    public function get_monthly_revenue()
    {
        $sql = "SELECT SUM(total) + SUM(total_charges) as ttl FROM `tbl_hall_booking`
                WHERE year(booking_date) = '2024' GROUP BY month(booking_date)";

        $array = $this->db->query($sql)->getResultArray();
        $revenues = [];
        foreach ($array as $arr) {

            $revenues[] = $arr['ttl'];
        }

        return $revenues;
    }
}
