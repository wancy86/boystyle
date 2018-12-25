<?php
header("Content-type: text/html; charset=utf-8");
require_once './lib/mysql.func.php';
// 101	潮装	T恤	男神 - T恤
// 102	潮装	裤子	男神 - 裤子
// 103	潮装	衬衣	男神 - 衬衣
// 104	鞋子	运动鞋	男神 - 运动鞋
// 105	鞋子	皮鞋	男神 - 皮鞋
// 106	鞋子	板鞋	男神 - 板鞋
// 201	送女友	连衣裙春夏	女神 - 连衣裙春夏
// 202	送女友	短裙	女神 - 短裙
// 203	送女友	饰品	女神 - 饰品
// 204	送女友	单鞋	女神 - 单鞋
// 205	送女友	凉鞋	女神 - 凉鞋
// 206	送女友	高跟鞋	女神 - 高跟鞋
// 207	送女友	丝袜	女神 - 丝袜
// 208	送女友	文胸	女神 - 文胸
// 209	送女友	内裤	女神 - 内裤
// 210	送女友	包包	女神 - 包包
// 211	送女友	护肤	女神 - 护肤
// 212	送女友	化妆品	女神 - 化妆品
// 301	小屁孩	小衣服	小屁孩 - 小衣服
// 302	小屁孩	小裤子	小屁孩 - 小裤子
// 401	品质生活	其他	品质生活 - 其他
// 402	品质生活	电子产品	品质生活 - 电子产品
// 501	趣玩	趣玩	趣玩
// 601	美食	美食	美食

$cat_id=$_GET["cat_id"];
echo $cat_id;
$query  =" select pro_id, title, img_url, detail_url, shop_name, price, month_sold, comm_percent, seller_ww, short_tbk_url, tbk_url";
$query .=" from BS_ProInfo as A ";
$query .=" join BS_Category as B on A.cat_id=B.cat_id ";
$query .=" where A.disabled=0 and B.cat_id in($cat_id)";
$query .=" order by A.pro_id";
$query .=" limit 0, 100";

$result = mysqli_query(connect(), $query);
$rows = array();
while (@$row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BoyStyle</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!--navbar-->
				<?php require_once 'header.php';?>			
				

				<!--content-->
				<?php
				    $index = 1;
                    foreach ($rows as $item) {
                        $item_tbk_url = $item["tbk_url"];
                        $item_title = $item["title"];
                        $item_img_url = $item["img_url"];
                        $item_title = $item["title"];
                        $item_price = $item["price"];
                        $item_comm_percent = $item["comm_percent"];
                        $item_month_sold = $item["month_sold"];
                        $item_tbk_url = $item["tbk_url"];
                        if($index % 4 == 1)
                        {
                            echo '<div class="row">';
                        } 
                        echo <<<theEnd
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <a href="$item_tbk_url" target="_blank"><img alt="$item_title" src="$item_img_url"/></a>
                                    <div class="caption">
                                        <h3>
                                            $item_title
            							</h3>
            							<p>
            								$item_price / $item_comm_percent
            							</p>
            						    <p>
            								月销量:$item_month_sold
            							</p>
            							<p>
            								<a class="btn btn-danger" href="$item_tbk_url" target="_blank">去看看</a> <a class="btn" href="#">收藏</a>
            							</p>
            						</div>
        					   </div>
    					   </div>
theEnd;
//标记好必须顶头写
            		    if($index % 4 == 0)
                        {
                            echo "</div>";                            
                        }
                        $index = $index+1;
                    }
                    if($index % 4 != 0)
                    {
                        echo "</div>";
                    }
                ?>
			    <!-- 
				<div class="row">			
					<div class="col-md-4">
						<div class="thumbnail">
							<img alt="Bootstrap Image Preview" src="http://lorempixel.com/418/418/"> 
							<div class="caption">
								<h3>
									Thumbnail label
								</h3>
								<p>
									Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
								</p>
								<p>
									<a class="btn btn-danger" href="#">去看看</a> <a class="btn" href="#">收藏</a>
								</p>
							</div>
						</div>
					</div>
				</div>
				-->

			</div>
		</div>

		<!--footer-->
		<?php require_once 'footer.php';?>
	</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

  </body>
</html>