<?php
if ( ! function_exists('renderPaginate'))
{
    /**
     * @param $currentPage
     * @param $perPage
     * @param $lastPage
     * @param $link
     * @return string
     * echo paginate
     */
    function renderPaginate($paginate,$filter = '')
    {
        return '<div class="custome-paginate clearfix">
                <div class="pull-right">'.$paginate->appends($filter)->links().'</div>
            </div>';
    }
}
if ( ! function_exists('randString')) {
    /*
     * @param length string
     * return string
     */
    function randString($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }
}


if(! function_exists('cateParent')) {
    /**
     * { function_description }
     *
     * @param      <type>   $data    The data
     * @param      integer  $parent  The parent
     * @param      string   $str     The string
     * @param      integer  $select  The select
     */
    function cateParent($data,$select_name="",$parent = 0, $str ='--',$select=0){
        foreach ($data as $key => $value)
        {
            $id = $value['id'];
            $name = $value['name'];

            if($value['parent_id'] == $parent )
            {
                if($select!=0 && $id ==$select)
                {
                    echo "<option";
                    if(old($select_name) == $value['id'] ){

                        echo 'selected ="selected"';

                    }
                    echo" value='".$value['id']."' selected='selected'> $str $name</option>";
                }
                else{
                    echo "<option ";
                    if(old($select_name) == $value['id'] ){

                        echo 'selected ="selected"';

                    }
                    echo"value='".$value['id']."'> $str $name</option>";
                }
                cateParent($data,$name,$id,$str.'--',$select);
            }

        }

    }
}

if(! function_exists('replaceUrlImage')) {
    function replaceUrlImage($link)
    {
        return str_replace('\\', '/', $link);
    }
}

/**
 * Convert text format
 *
 * @param      string  $str    The string
 * string nguyễn văn dược
 * @return     string nguyen-van-duoc
 */
if(! function_exists('safeTitle')) {
    function safeTitle($str = '')
    {

        $str = html_entity_decode($str, ENT_QUOTES, "UTF-8");
        $filter_in = array('#(a|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#', '#(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#', '#(e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#', '#(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#', '#(i|ì|í|ị|ỉ)#', '#(I|ĩ|Ì|Í|Ị|Ỉ|Ĩ)#', '#(o|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#', '#(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#', '#(u|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#', '#(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#', '#(y|ỳ|ý|ỵ|ỷ|ỹ)#', '#(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)#', '#(d|đ)#', '#(D|Đ)#');
        $filter_out = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'y', 'Y', 'd', 'D');
        $text = preg_replace($filter_in, $filter_out, $str);
        $text = preg_replace('/[^a-zA-Z0-9]/', ' ', $text);
        $text = trim(preg_replace('/ /', '-', trim(strtolower($text))));
        $text = preg_replace('/--/', '-', $text);
        $text = preg_replace('/--/', '-', $text);
        return preg_replace('/--/', '-', $text);
    }
}

/**
 * Convert text format
 *
 * @param string $str The string
 * @return string
 */
if (!function_exists('saveUrl')) {
    function saveUrl($str = '')
    {
        return safeTitle($str) . '-' . \Carbon\Carbon::now()->timestamp;
    }
}

/**
 * function Cut string
 *
 * @param    string $text
 * @return     string lenght $num
 */
if(! function_exists('theExcerpt')) {
    function theExcerpt($text, $num)
    {
        if (strlen($text) > $num) {

            $cutstring = substr($text, 0, $num);
            $word = substr($text, 0, strrpos($cutstring, ' '));
            return $word;

        } else {
            return $text;
        }

    }
}
if(! function_exists('formatDate')) {
    function formatDate($date_time, $date_format = 'd-m-Y') {
        $date = date_create($date_time);
        return $post_date = date_format($date, $date_format);
    }

}

if ( ! function_exists('paginatePage'))
{
    /**
     * @param $currentPage
     * @param $perPage
     * @param $lastPage
     * @param $link
     * @return string
     * echo paginate
     */
    function paginatePage($paginate,$filter = '')
    {
        return '<div class="custome-paginate clearfix">
                <div>'.$paginate->appends($filter)->links().'</div>
            </div>';
    }
}

if ( ! function_exists('tag'))
{
    /**
     * @param $currentPage
     * @param $perPage
     * @param $lastPage
     * @param $link
     * @return string
     * echo paginate
     */
    function tag($text)
    {
        return explode(',', $text);
    }
}

if ( ! function_exists('getStatus'))
{
    /**
     * @param $status
     * @return string
     * echo paginate
     */
    function getStatus($status)
    {
        $arr = [
            \App\Helpers\Constant::STATUS_DELETED => __('labels.general.status_deleted'),
            \App\Helpers\Constant::STATUS_ACTIVE => __('labels.general.status_active'),
            \App\Helpers\Constant::STATUS_INACTIVE => __('labels.general.status_inactive')
        ];
        return $arr[$status];
    }
}

if ( ! function_exists('getRole'))
{
    /**
     * @param $status
     * @return string
     * echo paginate
     */
    function getRole($role)
    {
        $arr = [
            \App\Models\User::ROLE_USER => __('labels.user.role_user'),
            \App\Models\User::ROLE_ADMIN => __('labels.user.role_admin'),
        ];
        return $arr[$role];
    }
}

if ( ! function_exists('getStatusOrder'))
{
    /**
     * @param $status
     * @return string
     * echo paginate
     */
    function getStatusOrder($status)
    {
        $arr = [
            \App\Helpers\Constant::STATUS_CLOSE => __('labels.general.status_close'),
            \App\Helpers\Constant::STATUS_NEW => __('labels.general.status_new'),
            \App\Helpers\Constant::STATUS_PROCESSING => __('labels.general.status_processing'),
            \App\Helpers\Constant::STATUS_DONE => __('labels.general.status_done')
        ];
        return $arr[$status];
    }
}

if ( ! function_exists('formatNumber'))
{
    /**
     * @param $number
     * @param $decimal
     * @param $decPoint
     * @param $thousands
     * @return string
     * echo paginate
     */
    function formatNumber($number, $decimal = 2, $decPoint = ',', $thousands = '.')
    {
        if (!$number) {
            return $number;
        }

        if (is_float($number)) {
            return number_format($number, $decimal, $decPoint, $thousands);
        }

        if (is_int($number)) {
            return number_format($number, 0, $decPoint, $thousands);
        }
    }
}

if ( ! function_exists('formatMoney'))
{
    /**
     * @param $number
     * @return string
     * echo paginate
     */
    function formatMoney($number)
    {
        return formatNumber($number, 0);
    }
}

if ( ! function_exists('getPosition'))
{
    /**
     * @param $status
     * @return string
     * echo paginate
     */
    function getPosition($position)
    {
        $arr = [
            \App\Helpers\Constant::POSITION_SLIDER => __('labels.banner.slider'),
            \App\Helpers\Constant::POSITION_BANNER => __('labels.banner.label'),
        ];
        return $arr[$position];
    }
}
