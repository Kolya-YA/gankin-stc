<?
class AutoThumb extends CComponent{
	static public function give($url, $w, $h)
	{
		$src = $_SERVER['DOCUMENT_ROOT'].'/'.$url;
//        D::dump("Path: " . $src . " <= § => " . $url . " <= § => " . $w. " <= § => " . $h);
		if (!file_exists($src))
		{
			header('HTTP/1.0 404 Not Found');
			exit;
		}
		else
		{
			$dest = $_SERVER['DOCUMENT_ROOT'].self::url($url, $w, $h);
			$dir = dirname($dest); 
			if (!file_exists($dir))
				mkdir($dir, 0777, true);
			$img_info = getimagesize($src);
			$image_type = $img_info[2];

			switch ($image_type)
			{
				case 2: # JPG
					$image = imagecreatefromjpeg($src);
					break;

				case 3: # PNG
					$image = imagecreatefrompng($src);
					break;

				case 1: # GIF 
					$image = imagecreatefromgif($src);
					break;
				default:
					$image = imagecreatefromjpeg($src);
			}
			$src_width = imagesx($image);
			$src_height = imagesy($image);

			list($w, $h) = self::get_proportional_sizes($src_width, $src_height, $w, $h);


			if (($w >= $src_width) && ($h >= $src_height))// dont need this shi
			{
				copy($src, $dest);
			}
			else
			{
				$thumbnail = ImageCreateTrueColor($w, $h);
				
				imagealphablending( $thumbnail, false );
				imagesavealpha( $thumbnail, true );
				imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $w, $h, $src_width, $src_height);
			
				switch ($image_type)
				{
					case 2:	# JPG
						header('Content-type: image/jpeg');
						imagejpeg($thumbnail, $dest, 100);

						break;
					case 3: # PNG
						header('Content-type: image/png');
						imagepng($thumbnail, $dest); 
						break;

					case 1:	# GIF 
						if (function_exists('imagegif'))
						{
							header('Content-type: image/gif');
							imagegif($thumbnail, $dest);  
						} else {
							header('Content-type: image/jpeg');
							imagejpeg($thumbnail, $dest, 100); 
						}
						break;
				}
				imagedestroy ($thumbnail);
			}
			
			imagedestroy ($image);
			
			$size = filesize($dest);
			header("Content-Length: $size");
			readfile($dest);
		}
	}
	
	static private function get_proportional_sizes($sw, $sh, $dw, $dh)
	{
		$src_ratio = $sw / $sh;
		$dest_ratio = $dw / $dh;
		
		if (($dw >= $sw) && ($dh >= $sh)) // и так влазит
			return array($sw, $sh);
			
		if ($src_ratio > $dest_ratio)
		{
			$dh = $dw / $src_ratio;
		}
		else
		{
			$dw = $dh * $src_ratio;
		}
		return array($dw, $dh);
	}

	static function url($url, $w, $h)
	{
		return preg_replace('/^(.+)\.([a-zA-Z]+)$/', "/thumb/$1[{$w}*{$h}].$2", ltrim($url, '/'));
	}
}