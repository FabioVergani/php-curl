<?php
/*
CURLOPT_RETURNTRANSFER => true,
TRUE to return the transfer as a string
of the return value of curl_exec()
instead of outputting it out directly.
+
CURLOPT_POST
TRUE to do a regular HTTP POST.
This POST is the normal application/x-www-form-urlencoded kind,
most commonly used by HTML forms.
*/
function curl($u,$t=true,$m){//u:url/str,t:transfer/flag,m:fields/array
 $r=false;
 $o=curl_init($u);unset($u);
 $c=array(CURLOPT_RETURNTRANSFER=>$t);unset($t);
 if(isset($m)){
  $c[CURLOPT_POST]=true;
  $c[CURLOPT_POSTFIELDS]=$m;unset($m);
 };
 if(curl_setopt_array($o,$c)){unset($c);
  $r=curl_exec($o);//SendRequest&StoreResponse
  $i=curl_errno($o);//CheckForError
  if($i){$r=('Error '.$i.':\t'.curl_error($o).'.');unset($i);};
  curl_close($o);unset($o);
 };
 return $r;
};
//test:
echo('-'.curl('http://.../pagecurled_post.php',1,array(item1=>'value1',item2=>'value2')).'-');
?>


/*
pagecurled_post.php
<?php
foreach($_POST as $n => $v) {
 echo 'POST parameter "'.$n.'" has value:"'.$v.'";';
}
?>
*/
