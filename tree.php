<html>
<body>

<style>

ul,#myul
{
  list-style-type:none;
}
#myul
{
  margin:0;
  padding:0;
}
.caret{
  cursor:pointer;
  user-select:none;
}
.caret::before{
  content: "\002B";
  color:black;
  display: inline-block;
  margin-right:6px;
  font-weight:bold;
  font-size:24px;
  
}
.caret-down::before{
  content: "\002D";
  font-weight:bold;
  font-size:24px;
  
}
.nested
{
  display:none;
}
.active
{
  display:block;
}
</style>


<ul id="myul">
<li> <span class="caret"><font size="6" color="blue">Monthly Reco</font></span>
		<ul class="nested">
			<li>P-TAX</li>
			<l1>NPS</li>
			<li><span class="caret">IT-TCS</span>
				<ul class="nested">
					<li><a style="cursor:pointer;" onclick='window.open("upload_12.php?nam=2022-2023_P-TAX")'>206CE(SCRAP)</a></li>
					<li>206C(I)H</li>
				</ul>
			</li>
			<li><span class="caret">IT-TDS
				<ul class="nested">
					<li>192B(SALARY)</li>
					<li>192C(Vendor)</li>	
					<li>129H(MSTC)</li>
				</ul>
			</li>
		</ul>
		<script >
var toggler=document.getElementsByClassName("caret");
var i = 0;
for(i=0;i<toggler.length;i++)
{
  toggler[i].addEventListener("click",function()
  {
  	this.parentElement.querySelector(".nested").classList.toggle("active");
	this.classList.toggle("caret-down");
	  
  }
  );
  
}

</script>
		</body>
		</html>