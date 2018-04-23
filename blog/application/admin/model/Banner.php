<?php
namespace app\admin\model;
use think\Model;
class Banner extends Model
{
	// 关闭自动写入createTime字段
	protected $createTime = false;
	// 关闭自动写入update_time字段
	protected $updateTime = false;
	protected static function init()
	{
		//上传图片
		Banner::event('before_insert',function($banner)
		{
			if($_FILES['bannert']['tmp_name']){                     
				$file = request()->file('bannert');
				$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
				if($info){
					$bannert='' . DS . 'uploads' . '/' .$info->getSaveName();
					$banner['bannert']=$bannert;
				}
			}
		});


		//删除图片
		Banner::event('before_delete',function($banner)
		{
			$ban=Banner::find($banner->id);
			$bannertpath=$_SERVER['DOCUMENT_ROOT'].$ban['bannert'];
			if(!empty($bannertpath)) {
				$bannertpath=unlink($bannertpath);
			}	
		});
	}
}
