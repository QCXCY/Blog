<?php
namespace app\admin\model;

use think\Model;

class Article extends Model
{
	// 定义时间戳字段名
	protected $createTime = 'time';
    // 关闭自动写入update_time字段
	protected $updateTime = false;

	protected static function init()
	{
		//上传图片
		Article::event('before_insert',function($article)
		{
			if($_FILES['plan']['tmp_name']){                     
				$file = request()->file('plan');
				$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
				if($info){
					$plan=''. DS . 'uploads' . '/' .$info->getSaveName();
					$article['plan']=$plan;
				}
			}
		});

	//修改上传图片删除原图片
		  Article::event('before_update',function($article)
		  {
		  	if ($_FILES['plan']['tmp_name']) {
		  		$art=Article::find($article->id);
		  		$planpath=$_SERVER['DOCUMENT_ROOT'].$art['plan'];
				if(!empty($planpath)) {
		  			$planpath=unlink($planpath);
		  		}
		  		$file = request()->file('plan');
		  		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		  		if($info){
		  			$plan='' . DS . 'uploads'.'/'.$info->getSaveName();
		  			$article['plan']=$plan;
		  		}
		  	}
		  });

		//删除图片
		Article::event('before_delete',function($article)
		{
			$art=Article::find($article->id);
			$planpath=$_SERVER['DOCUMENT_ROOT'].$art['plan'];
			if(!empty($planpath)) {
				$planpath=unlink($planpath);
			}	
		});
	}
}