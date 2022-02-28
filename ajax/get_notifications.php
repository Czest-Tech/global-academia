<?php
if (IS_LOGGED == false) {
    $data = array(
        'status' => 400,
        'error' => 'Not logged in'
    );
    echo json_encode($data);
    exit();
} else {
    
    if ($first == 'notifications') {
        $user_id   = $kd->user->id;
        $type      = (!empty($_GET['t'])) ? Secure($_GET['t']) : 'all';
        $show_all  = (!empty($_GET['sa'])) ? Secure($_GET['sa']) : false;
        $target    = (!empty($_GET['target'])) ? Secure($_GET['target']) : 'all' ;
        $html      = "";
        $no_data = "<span class='no-notifications' style='text-align:center; min-height:50px; display:flex; align-items:center; justify-content:center;' >".__('you_do_not_have_any_notifications') ."</span>";
        $t_notif   = T_NOTIFICATIONS;
        $notif_set = GetNotification(array(
            'recipient_id' => $user_id,
            'type' => $type,
            'target' => $target
        ));
        if ($type == 'new' && !empty($notif_set) && is_numeric($notif_set)) {
            $data['status'] = 200;
            $data['new']    = intval($notif_set);
        } else if (($type == 'all' || $type == 'only_new') && count($notif_set) > 0) {
            $update = array();
            $new    = 0;
            foreach ($notif_set as $data_row) {
                $data_row['notifier'] = UserData($data_row['notifier_id']);
                $icon                 = $kd->notif_data[$data_row['type']]['icon'];
                $title                = $kd->notif_data[$data_row['type']]['text'];
                $html .= LoadPage('components/notifications', array(
                    'ID' => $data_row['id'],
                    'USER_DATA' => $data_row['notifier'],
                    'TITLE' => $title,
                    'TEXT' => $data_row['text'],
                    'URL' => UrlLink($data_row['url']),
                    'TIME' => Time_Elapsed_String($data_row['time']),
                    'SEEN' => $data_row['seen'],
                    'ICON' => $icon
                ));
                $update[] = $data_row['id'];
                if (empty($data_row['seen'])) {
                    $new++;
                }
            }
            $db->where('recipient_id', $kd->user->id)->update($t_notif, array(
                'seen' => time()
            ));
            $data['status'] = 200;
            $data['html']   = $html;
            $data['len']    = count($notif_set);
            $data['new']    = $new;

        } else {
            $data['status'] = 304;
            $data['html'] = $no_data;
        }
    }
}
    
