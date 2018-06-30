<?php
require('function.php');
$urls = explode("/", $_SERVER['REQUEST_URI']);
//asin
$asin = str_replace("file-", "", $urls['1']);
// title
$title = str_replace(".pdf", "", $urls['2']);
$aad = ucwords(str_replace("-", " ", $title));
$titles = truncate($aad, 232, 40);

if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot"))
{
error_reporting(0);
ini_set('memory_limit','-1');
require('fpdf/fpdf.php');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
// meta
$pdf->SetTitle('[PDF] [EPUB] '.str_replace(".pdf", "", $aad). ' Download');
$pdf->SetSubject('[PDF] [EPUB] '.str_replace(".pdf", "", $aad). ' Download');
$pdf->SetAuthor($_SERVER['HTTP_HOST']);
$pdf->SetCreator($_SERVER['HTTP_HOST']);
$pdf->SetKeywords(''.$titles.' free pdf download, '.$titles.' book free, download '.$titles.' pdf free, '.$titles.' pdf ebook download, '.$titles.' download free, '.$titles.' free pdf download, '.$titles.' pdf book for download free, ebook <?php echo strtolower($author); ?> free download, read online ebook  '.$titles.', ebook  '.$titles.' pdf download, '.$titles.' pdf full download, download  '.$titles.' pdf unlimited download,  '.$titles.' pdf ebook, Download Books '.$titles.', Download Books '.$titles.' Online, Download Books '.$titles.' Pdf, Download Books '.$titles.' For Free, Books '.$titles.' To Read, Read  Online  '.$titles.' Books, Free Ebook '.$titles.' Download, Ebooks '.$titles.' Free Download Pdf, Free Pdf Books '.$titles.' Download, Read Online Books '.$titles.' For Free Without Downloading');
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(61, 83, 250);
$pdf->Cell(60);
$pdf->Write('14', $titles.' PDF');
$pdf->Ln();
$pdf->Cell(10);
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,0,0);
$pdf->Write('12','[PDF] [EPUB] '.str_replace(".pdf", "", $titles). ' Download');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Write('5','[PDF] [EPUB] '.$titles.'. Download free ebook of '.$titles.' soft copy pdf.');
$pdf->Ln();
$pdf->SetFont('Arial','B',14);
$pdf->Write('10','Brief Summary of '.$titles);

// desc line1
$pdf->Ln(13);
$pdf->SetFont('Arial','',10);
$pdf->Write('5','[PDF] [EPUB] '.$titles.'. Download free ebook of '.$titles.' soft copy pdf or read online? This is a best area for you to discover what you are looking for. Now, you can check out and also download the book of '.$titles.' free of charge. We provide the downloading and install media like a pdf, word, ppt, txt, zip, rar, and kindle.');
// desc line2
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Write('5','Have free times? Read '.$titles.' Why? A best seller book on the planet with great value as well as material iscombined with appealing words. Where? Merely here, in this website you can review online. Want download? Naturally available, download them additionally here. Available files are as word, ppt, txt, kindle, pdf, rar, and also zip.');
// desc line3
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Write('5','Below, you can discover '.$titles.' free of charge. It is offered free of charge downloading and reading online. provides a brand-new edition for you. Now, simply get it with the type of word, pdf, ppt, txt, kindle, rar, as well as zip.');
// desc line4
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Write('5','Have you searched for this ebook '.$titles.' Or you want to read it online? Visit the internet site now as well as obtainthe data or review '.$titles.' online. You can get it as pdf, kindle, word, txt, ppt, rar and zip data.');

$pdf->Output();
}else{
?>
<!DOCTYPE html>
<html lang='EN'>
<head>
<!-- Histats.com  START  (aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,3998434,4,0,0,0,00010000']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3998434&101" alt="free site statistics" border="0"></a></noscript>
<!-- Histats.com  END  -->
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Read : <?php echo $aad ?></title>
<meta name='description' content='Currently no descriptions for this product and will be added soon.' />
<meta http-equiv='language' content='EN'>
<meta property='og:title' content='Read : <?php echo $aad ?>'/>
<link rel='canonical' href='http://millionsbooks.co/free'/>
<script type='text/javascript'>
var url = 'http://millionsbooks.co/free';
var delay = '2000';

window.onload = function ()
{
  DoTheRedirect()
}
function DoTheRedirect()
{
  setTimeout(GoToURL, delay)
}
function GoToURL()
{
  // IE8 and lower fix
  if (navigator.userAgent.match(/MSIE\s(?!9.0)/))
  {
    var referLink = document.createElement('a');
    referLink.href = url;
    document.body.appendChild(referLink);
    referLink.click();
  }

  // All other browsers
  else { window.location.replace(url); }
}
</script>
<!--REDIRECTING ENDS-->
</head>
<body>
<p align="middle"><img src="http://millionsbooks.co/wp-content/uploads/2018/03/load.gif" vspace="200">
</body>
</html>
<?php } ?>
