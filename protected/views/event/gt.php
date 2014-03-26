<h1>Tree</h1>
<script>
	function delNode(id){
		var pr = confirm("Are you sure, you want to delete Node №"+id+" \""+$("#nodename_"+id).text()+":"+$("#nodedesc_"+id).text()+"\"");
			if(pr){
				$(".node_"+id).remove();
				$.post("/event/AdminGT",{"do":"delNode","id":id});
			}
	}
	function editNode(id){
		var tx = prompt("Изменить имя:", $("#nodename_"+id).text());
		if(tx != null){
			var tx2 = prompt("Изменить описание:", $("#nodedesc_"+id).text());
			if(tx2 != null){
				$("#nodename_"+id).text(tx);
				$("#nodedesc_"+id).text(tx2);
				$.post("/event/AdminGT",{"do":"editNode","id":id,"name":tx, "desc":tx2});
			}
		}
	}
	function addNode(ref){
		var ngr = prompt("Добавить узел");
		if(ngr != null){
			var desc = prompt("Описание");
			if(desc != null){
				$.post("/event/AdminGT",{"do":"addNode","name":ngr,"lang":"ua", "desc":desc, 'ref':ref},
					function(data){
						//alert(data);
						if(ref>0){
							$("#node_"+ref).append("<ul class='node_'"+ref+"><li id=\"node_"+data+"\" class=\"node_"+data+"\"><input type=button onClick=\"delNode("+data+")\" value=\"D\"><input type=button onClick=\"editNode("+data+")\" value=\"E\"><input type=button onClick=\"addNode("+data+")\" value=\"v\"><div id=\"nodename_"+data+"\">"+ngr+"</div><div id=\"nodedesc_"+data+"\">"+desc+"</div></li></ul>");
						}else{
							$("#node_"+ref).append("<li id=\"node_"+data+"\" class=\"node_"+data+"\"><input type=button onClick=\"delNode("+data+")\" value=\"D\"><input type=button onClick=\"editNode("+data+")\" value=\"E\"><input type=button onClick=\"addNode("+data+")\" value=\"v\"><div id=\"nodename_"+data+"\">"+ngr+"</div><div id=\"nodedesc_"+data+"\">"+desc+"</div></li>");
						}
					}
				);
			}
		}
	}
</script>
<input type=button onClick="addNode(0)" value="Add Node"><br>
<?php
	function display_nodes($tree, $ref){
		
		foreach($tree as $node){
				if($node['refer']==$ref){
					echo "<li id=\"node_".$node['id']."\" class=\"node_".$node['id']."\"><input type=button onClick=\"delNode(".$node['id'].")\" value=\"D\"><input type=button onClick=\"editNode(".$node['id'].")\" value=\"E\"><input type=button onClick=\"addNode(".$node['id'].")\" value=\"v\"><div id=\"nodename_".$node['id']."\">".$node['name']."</div><div id=\"nodedesc_".$node['id']."\">".$node['description']."</div></li>\n";
					echo "<ul class=\"node_".$node['id']."\">\n";
					display_nodes($tree,$node['id']);
					echo "</ul>\n";
				}
			}
	}
echo "<ul class=\"node_0\" id=\"node_0\">\n";
	display_nodes($tree,0);
echo "</ul>\n";
?>
