<?php include './simple_html_dom/simple_html_dom.php';?>
<?php
    //解析html
    function htmlParse($url)
    {
        $html = new simple_html_dom(); ;
        $html->load_file($url);                                //加载对应url
        $div = $html->find('.articleText');                    //获取博客内容div
        $nextUrl = $html->find('.pagingNext')[0]->href;        //获取下一篇博客链接
        $blogTime = $html->find('time')[0]->plaintext;         //获取博客发送时间
        $fileName = explode( ' ', $blogTime)[0];
        $folderName = substr($fileName, 0, 7);
        if (!file_exists($folderName)) {                         //判断是否存在文件夹
            mkdir('./'.$folderName);                             //无则新建
        } 
        
        $img = $div[0]->find('img');                           //找到该div下所有img
        for ($i=0; $i < count($img); $i++) { 
            $data = file_get_contents($img[$i]->src);
            file_put_contents('./'.$folderName.'/'.$fileName.'_'.$i.'.jpg' , $data);
        }
        echo '<img src="https://imgsa.baidu.com/forum/w%3D580/sign=81a47384c3cec3fd8b3ea77de689d4b6/ffe980b1cb1349543195662c564e9258d0094aa1.jpg">';
    } 
    $url = 'https://ameblo.jp/lxixsxa';
    htmlParse($url);
    

?>

