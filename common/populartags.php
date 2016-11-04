<div class="col-sm-5">
    <div class="footer-title text-black text-uppercase mb-30 xs-mb-20">popular tags</div>
    <div class="footer-tag lg-pr-10 sm-pr-0">
            <ul class="list-inline">
                <li><i class="fa fa-tags" aria-hidden="true"></i></li>
                <?php //$tag_query = "select tag_name, max(`count`) as cnt FROM tag WHERE `tagof`='1' group by `id` order by cnt desc LIMIT 0,50";
                      $tag_query = "select tag_name, max(`count`) as cnt FROM tag WHERE `tagof`='0' group by `id` order by cnt desc LIMIT 0,40";
                      $tag_res = mysqli_query($conn, $tag_query); 
                      while($tag_row = mysqli_fetch_assoc($tag_res)) {
                            $tag_nm = $tag_row['tag_name'];?>
                            <li>
                                <a onclick="func_tag_details('<?=$tag_nm?>')"><?php echo $tag_nm;?></a>
                            </li>
                <?php } ?>   
            </ul>
    </div>
</div>
<script type="text/javascript">
function func_tag_details(tag_nm) {
        var $link = $(this);
        $('<form/>', { action: 'tag-details.php', method: 'POST' })
            .append($("<input>").attr("type", "hidden").attr("name", "tagname").val(tag_nm)).appendTo('body').submit(); 
}
</script>