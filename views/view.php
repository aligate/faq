{% include 'header.php'%}
<section class="cd-faq">
	
	<ul class="cd-faq-categories">

	{%for key, value in data%}
		
	
		<li><a href="#{{key|lower|replace({' ':''})}}">{{key}}</a></li>
		
	{%endfor%}
	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
	{%for key, value in data%}
		<ul id="{{key|lower|replace({' ':''})}}" class="cd-faq-group">
			<li class="cd-faq-title"><h2>{{key}}</h2></li>
				{%for item in value%}
			<li>
				<a class="cd-faq-trigger" href="#{{item.id}}">{{item.req_text}}</a>
				<div class="cd-faq-content">
					<p>{{item.res_text}}</p>
				</div> <!-- cd-faq-content -->
			</li>
			{%endfor%}
			
	</ul> <!-- cd-faq-group -->
		{%endfor%}
		<br>
	
    <span class="button"> 
   <a href="?/main/form/"><input id="button" type="button" value="Или задайте ваш вопрос"></a>
	</span>	
	</div> <!-- cd-faq-items -->
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
{% include 'footer.php'%}