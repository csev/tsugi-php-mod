<?php

require_once('data_util.php');

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

$sanity = array(
  'urllib' => 'You should use urllib to retrieve the data from the URL'
);

// Compute the stuff for the output
$code = 42;
$new = getShuffledNames($code);
$nums = getRandomNumbers($code,min(50,count($new)),100);
$sum_sample = array_sum($nums);

$code = $USER->id+$LINK->id+$CONTEXT->id;
$new = getShuffledNames($code);
$nums = getRandomNumbers($code,min(50,count($new)),100);
$sum = array_sum($nums);

$oldgrade = $RESULT->grade;
if ( isset($_POST['sum']) && isset($_POST['code']) ) {
    $RESULT->setJsonKey('code', $_POST['code']);

    if ( $_POST['sum'] != $sum ) {
        $_SESSION['error'] = "Your sum did not match";
        header('Location: '.addSession('index.php'));
        return;
    }

    $val = validate($sanity, $_POST['code']);
    if ( is_string($val) ) {
        $_SESSION['error'] = $val;
        header('Location: '.addSession('index.php'));
        return;
    }

    LTIX::gradeSendDueDate(1.0, $oldgrade, $dueDate);
    // Redirect to ourself
    header('Location: '.addSession('index.php'));
    return;
}

// echo($goodsha);
if ( $LINK->grade > 0 ) {
    echo('<p class="alert alert-info">Your current grade on this assignment is: '.($LINK->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}
$url = curPageUrl();
$sample_url = str_replace('index.php','data/comments_42.xml',$url);
$actual_url = str_replace('index.php','data/comments_'.$code.'.xml',$url);
?>
<p>
<b>Extracting Data from XML</b>
<p>
In this assignment you will write a Python program somewhat similar to 
<a href="http://www.pythonlearn.com/code/geoxml.py" target="_blank">http://www.pythonlearn.com/code/geoxml.py</a>.  
The program will prompt for a URL, read the XML data from that URL using 
<b>urllib</b> and then parse and extract the comment counts from the XML data, 
compute the sum of the numbers in the file.
</p>
<p>
We provide two files for this assignment.  One is a sample file where we give you the sum for your
testing and the other is the actual data you need to process for the assignment.  
<ul>
<li> Sample data: <a href="<?= deHttps($sample_url) ?>" target="_blank"><?= deHttps($sample_url) ?></a> 
(Sum=<?= $sum_sample ?>) </li>
<li> Actual data: <a href="<?= deHttps($actual_url) ?>" target="_blank"><?= deHttps($actual_url) ?></a> 
(Sum ends with <?= $sum%100 ?>)<br/> </li>
</ul>
You do not need to save these files to your folder since your
program will read the data directly from the URL.
<b>Note:</b> Each student will have a distinct data url for the assignment - so only use your
own data url for analysis.
</p>
<b>Data Format and Approach</b>
<p>
The data consists of a number of names and comment counts in XML as follows:
<pre>
&lt;comment&gt;
  &lt;name&gt;Matthias&lt;/name&gt;
  &lt;count&gt;97&lt;/count&gt;
&lt;/comment&gt;
</pre>
You are to look through all the &lt;comment&gt; tags and find the &lt;count&gt; values
sum the numbers.  
The closest sample code that shows how to parse XML is 
<a href="http://www.pythonlearn.com/code/geoxml.py" target="_blank">geoxml.py</a>.
But since the nesting of the elements in our data is different than the data 
we are parsing in that sample code you will have to make real changes to the code.
</p>
<p>
To make the code a little simpler, you can use an XPath selector string to 
look through the entire tree of XML for any tag named 'count' with the following 
line of code:
<pre>
counts = tree.findall('.//count')
</pre>
Take a look at the Python ElementTree documentation and look for the supported XPath
syntax for details.  You could also work from the top of the XML down to the comments 
node and then loop through the child nodes of the comments node.
</p>
<p><b>Sample Execution</b></p>
<p>
<pre>
$ python solution.py 
Enter location: http://pr4e.dr-chuck.com/tsugi/mod/python-data/data/comments_42.xml
Retrieving http://pr4e.dr-chuck.com/tsugi/mod/python-data/data/comments_42.xml
Retrieved 4210 characters
Count: 50
Sum: 2553
</pre>
<?php httpsWarning($sample_url); ?>
<p><b>Turning in the Assignment</b></p>
<form method="post">
Enter the sum from the actual data and your Python code below:<br/>
Sum: <input type="text" size="20" name="sum">
(ends with <?= $sum%100 ?>)
<input type="submit" value="Submit Assignment"><br/>
Python code:<br/>
<textarea rows="20" style="width: 90%" name="code"></textarea><br/>
</form>
