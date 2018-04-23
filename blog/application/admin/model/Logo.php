<?php
namespace app\admin\model;
use think\Model;
class Logo extends Model
{
	// 关闭自动写入createTime字段
	protected $createTime = false;
	// 关闭自动写入update_time字段
	protected $updateTime = false;
	protected static function init()
	{
		//上传图片
		Logo::event('before_insert',function($logo)
		{
			if($_FILES['logot']['tmp_name']){                     
				$file = request()->file('logot');
				$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
				if($info){
					$logot=''.  DS . 'uploads' . '/' .$info->getSaveName();
					$logo['logot']=$logot;
				}
			}
		});


		//删除图片
		Logo::event('before_delete',function($logo)
		{
			$lo=Logo::find($logo->id);
			$logotpath=$_SERVER['DOCUMENT_ROOT'].$lo['logot'];
			if(!empty($logotpath)) {
				$logotpath=unlink($logotpath);
			}	
		});
	}
}
