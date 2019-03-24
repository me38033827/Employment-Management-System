<?php
	session_start();
	$checkCode="";
	for($i=0;$i<4;$i++){
		$checkCode.=dechex(rand(1,15));
	}

	//�������֤�뱣�浽session��
	$_SESSION['myCheckCode']=$checkCode;
	//����ͼƬ���������������ȥ
	$img=imagecreatetruecolor(110,50);
	//����Ĭ���Ǻ�ɫ
	//������ƶ�������ɫ

	$bgcolor=imagecolorallocate($img,0,0,0);
	imagefill($img,0,0,$bgcolor);
	//�����µ���ɫ
	$white=imagecolorallocate($img,255,255,255);
	$bule=imagecolorallocate($img,0,0,255);
	$red=imagecolorallocate($img,255,0,0);
	$green=imagecolorallocate($img,0,255,0);
	//���������߶�
	for($i=0;$i<20;$i++){
		/*switch(rand(1,4)){
			case 1:
				imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$green);
				break;
			case 2:
				imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$blue);
				break;
			case 3:
				imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$red);
				break;
			case 4:
				imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$green);
				break;
		}*/
		imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255)));

	}
	//������㣬�Լ���
	//���ĸ����ֵ����ȥ
	imagestring($img,rand(1,5),rand(2,80),rand(2,10),$checkCode,$white);
	header("content-type: image/png");
	imagepng($img);
	
	
?>