<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
 
    <title>留言板</title>
    <style type="text/css">
            html{
                 height: 100%;
            }
            body{
                background-image: url(bg.jpg);
                background-repeat: no-repeat;
                background-size: 100% 100%;
                background-attachment: fixed;
                height: 100%;
            }
            .top_div{
                background-image: url(title.png);
                background-repeat: no-repeat;
                background-size: 100% 100%;
               
                width:100%;
                height:250px;
                
            }
        </style>
        <script type="text/javascript">
            function _check(){
                if(document.myForm.author.value.length == 0 || document.myForm.subject.value.length == 0 || document.myForm.text.value.length == 0){
                    alert("請填完資料");
                }
                else{
                    myForm.submit();
                }
            }
            
            
        </script>
</head>
<body>
    <div class='top_div'></div>
    <?php
        require_once("dbtools.inc.php");
        $page_count = 5;
        if(isset($_GET["page"])){
            $page = $_GET["page"];
        }
        else{
            $page = 1;
        }
        $link = create_connection();
        $sql = "SELECT * FROM users ORDER BY date DESC";
        $result = execute_sql($link,"Portfolio_2",$sql);
        
        $total_text = mysqli_num_rows($result);
        $total_page = ($total_text / $page_count) + 1;
        
        $start_text = $page_count * ($page-1);
        
        mysqli_data_seek($result,$start_text);
        
        echo "<table width='800' align='center' cellspacing='3'>";
        
        $j=1;
        $bg[0]="#D9D9FF";
        $bg[1]="#FFFFCC";
        
        while($row = mysqli_fetch_assoc($result)and $j <= $page_count){
            
           // echo 
            
            echo "<tr bgcolor='".$bg[$j%2]."'>";
            echo " <td width='120' align='center' >".$j."</td>";
            echo "<td>作者:".$row["author"]."<br>";
            echo "主題:".$row["subject"]."<br>";
            echo "時間:".$row["date"]."<br>";
            echo $row["context"]."</td></tr>";  
                 
            $j++;
            
            
        }
    
        echo "</table>";
        
       echo "<p align='center' >";
        if($page > 1){
            echo "<a href='index.php?page=".($page-1)."'>上一頁</a>";
        }
        for($i = 1;$i<=$total_page;$i++){
            if($i==$page){
                echo "$i";
                
            }
            else{
                echo "<a href='index.php?page=$i'>$i </a>";
                    
            }
            
        }
        if($page < $total_pages){
            echo  "<a href='index.php?page=".($page+1)."'>下一頁</a>";
        }
        echo "</p>";
    
        mysqli_free_result($result);
        mysqli_close($link);
        
        
        
    
        
    ?>
    
    
    <form name="myForm" method="post" action="post.php">
        <table border="1" width="800" align="center">
            <tr>
                <td colspan="2">
                    <font>請輸入留言</font>
                </td>
            </tr>
            <tr>
                <td width=15%>
                    <font>作者</font>
                </td>
                <td width=85%>
                    <input name="author" type="text" size="50">
                </td>
            </tr>
            <tr>
                <td width=15%>
                    <font>主題</font>
                </td>
                <td >
                    <input name="subject" type="text" size="50">
                </td>
            </tr>
            <tr>
                <td width=15%>
                    <font>內容</font>
                </td>
                <td >
                    <textarea name="text" size="500" cols="5" rows="5" style="width:70%;height:100px;"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="button" value="發佈留言" onClick="_check()">
                    <input type="reset" value="重新輸入">
                </td>
            </tr>
        </table>
    
    </form>
    
    
</body>
</html>