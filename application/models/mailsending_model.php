<?php

class Mailsending_Model extends CI_Model {

    function __construct() {

        $this->from = "";
        $this->sendermail = "info@diodiesso.com";
        $this->sitelogo = '';

        $this->site_title = $this->config->item('site_title');
        $this->contact_email = '';
        $this->mailtype = 'html';
        $this->sitelogo = base_url() . 'assets/email_template_images/logo.png';
        $this->background = base_url() . "assets/email_template_images/body-bg.png";
    }

    function templatechoose($id) {
        $this->db->where('tbl_email_template.template_id', $id);
        $this->db->where('tbl_email_template.status', 'active');
        $query = $this->db->get('tbl_email_template');
        $result = $query->row();
        return $result;
    }

    function subscribeMail() {
        $template = $this->templatechoose(2);
        $str = str_replace("{#background}", $this->background, $template->template_description);
        $str = str_replace("{#logopath}", $this->sitelogo, $str);
        $str = str_replace("{#email_id}", $this->input->post('email_address'), $str);
        $str = str_replace("{#site_title}", $this->site_title, $str);
        $this->email->from($template->sender_from_email, $template->name_from_email);
        $this->email->to($template->sender_to_email);
        $this->email->mailtype = $this->mailtype;
        $this->email->subject($template->email_subject);
        $this->email->message($str);
        //echo $str; die;
        return $this->email->send();
    }

    function contactusmail() {
        $template = $this->templatechoose(1);
        $str = str_replace("{#background}", $this->background, $template->template_description);
        $str = str_replace("{#logopath}", $this->sitelogo, $str);
        $str = str_replace("{#full_name}", ucfirst($this->input->post('full_name')), $str);
        $str = str_replace("{#email_id}", $this->input->post('email_id'), $str);
        $str = str_replace("{#subject}", $this->input->post('subject'), $str);
        $str = str_replace("{#message}", $this->input->post('message'), $str);
        $str = str_replace("{#site_title}", $this->site_title, $str);
        $this->email->from($template->sender_from_email, $template->name_from_email);
        $this->email->to($template->sender_to_email);
        $this->email->mailtype = $this->mailtype;
        $this->email->subject($template->email_subject);
        $this->email->message($str);
        // echo $str;
        //die;
        return $this->email->send();
    }

    public function orderMail($order_id) {
        $this->load->model('order_model', 'order');
        $order_detail = $this->order->getOrderDetailById($order_id);
        $order_items = $this->order->getOrderItems($order_id);
        // pr($order_detail);die;
        $order_detail = (object) $order_detail;
        $template = $this->templatechoose(2);


        foreach ($order_items as $item) {
            $items.=' <tr><td><table width="100%" border="0" cellspacing="0" cellpadding="5" style="border-top:solid 1px #ccc"><tr><td width="16%"><img src="http://64.77.51.231/~catslinks/assets/uploads/product_images/' . $item->product_image . '" width="86" height="53" /></td><td width="66%" style="padding:10px;">' . $item->product_title . '</td><td width="18%" style="font-size:18px; color:#CC0000;">$' . number_format($item->unit_product_price, '2', '.', '') . '</td></tr></table></td></tr><tr><td>&nbsp;</td></tr>';
        }

        $items1.='<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:solid 1px #ccc;"><tr><td width="60%">&nbsp;</td><td width="40%"><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr><td width="53%">Item Subtotal </td><td width="9%">:</td><td width="38%">$' . number_format($order_detail->sub_total, 2, '.', '') . '</td></tr>';
        if ($order_detail->gst_per != '0' || $order_detail->gst_per != '0.00')
            $items1.='<tr><td>Estimated Tax </td><td>:</td><td>$' . number_format($order_detail->gst, 2, '.', '') . '</td></tr>';
        if ($order_detail->discount != '0' || $order_detail->discount != '0.00')
            $items1.='<tr><td>Discount</td><td>:</td><td>-$' . number_format($order_detail->discount, 2, '.', '') . '</td></tr>';
        $items1.='<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr style="font-weight:800;"><td>Order Total </td><td>:</td><td>$' . number_format($order_detail->total_amount, 2, '.', '') . '</td></tr></table>';


//echo $items;die;
        $str = str_replace("{#background}", $this->background, $template->template_description);
        $str = str_replace("{#logopath}", $this->sitelogo, $str);
        $str = str_replace("{#background}", $this->background, $template->template_description);
        $str = str_replace("{#logopath}", $this->sitelogo, $str);
        $str = str_replace("{#full_name}", ucfirst($order_detail->firstname . ' ' . $order_detail->last_name), $str);
        $str = str_replace("{#email_id}", $order_detail->email_id, $str);
        $str = str_replace("{#order_id}", $order_detail->order_id, $str);
        $str = str_replace("{#address}", $order_detail->address, $str);
        $str = str_replace("{#contact}", $order_detail->contact_no, $str);
        $str = str_replace("{#add_date}", date('d-m-Y', $order_detail->add_time), $str);
        $str = str_replace("{#add_time}", date('h:i:s', $order_detail->add_time), $str);
        $str = str_replace("{#payment_type}", $order_detail->payment_type, $str);
        $str = str_replace("{#total_price}", $order_detail->total_amount, $str);
        $str = str_replace("{#items}", $items, $str);
        $str = str_replace("{#items1}", $items1, $str);
        $str = str_replace("{#subject}", "Thanks For Order", $str);
        $str = str_replace("{#message}", "Thanks For Order", $str);
        $str = str_replace("{#site_title}", $this->site_title, $str);
        $this->email->from($template->sender_from_email, $template->name_from_email);
        $this->email->to($template->sender_to_email);
        $this->email->cc($template->sender_to_email . ',' . $order_detail->email_id);
        $this->email->mailtype = $this->mailtype;
        $this->email->subject($template->email_subject);
        $this->email->message($str);
         echo $str;
        //die;
        return $this->email->send();
    }

    function quotationmail() {
        $template = $this->templatechoose(5);
        //$str = str_replace("{#background}", $this->background, $template->template_description);
        // $str = str_replace("{#logopath}", $this->sitelogo, $str);
        $str = str_replace("{#full_name}", ucfirst($this->input->post('full_name')), $str);
        $str = str_replace("{#email_id}", $this->input->post('email_id'), $str);
        $str = str_replace("{#subject}", $this->input->post('subject'), $str);
        $str = str_replace("{#message}", $this->input->post('message'), $str);
//        $str = str_replace("{#signLocation}", $this->input->post('sign_location'), $str);
//        $str = str_replace("{#signType}", $this->input->post('sign_type'), $str);
//        $str = str_replace("{#signDimensions}", $this->input->post('sign_dimension'), $str);
//        $str = str_replace("{#comment}", $this->input->post('comment'), $str);
//        $str = str_replace("{#site_title}", $this->site_title, $str);
        $this->email->from($template->sender_from_email, $template->name_from_email);
        $this->email->to($template->sender_to_email);
        $this->email->mailtype = $this->mailtype;
        $this->email->subject($template->email_subject);
        $this->email->message($str);

        return $this->email->send();
    }

    function sendNewsletter($email_address, $newsletter) {

        $str = $newsletter->newsletter_text;
        $this->email->from($this->config->item('site_email'), $template->name_from_email);
        $this->email->to($email_address);
        $this->email->mailtype = $this->mailtype;
        $this->email->subject($newsletter->newsletter_title);
        $this->email->message($str);
        //	echo $str; die;
        return $this->email->send();
    }

}
