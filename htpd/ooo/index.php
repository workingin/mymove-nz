<script>
    $('#showPdf').click(function() {
      var pdf = new jsPDF();  
      pdf.addHTML($("#divContent"), function() {
    	var blob = pdf.output("blob");
        window.open(URL.createObjectURL(blob));
      });
    });
$('#downloadPdf').click(function() {
  var pdf = new jsPDF();  
  pdf.addHTML($("#divContent"), function() {
	pdf.save('pageContent.pdf');
  });
});
   </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div id="divContent" style="background-color: white; padding:20px 25px">
      <h3>SEA MINK</h3>
      <p>The sea mink (Neovison macrodon) was a mammal from the eastern coast
      of North America, in the family of weasels and otters in the order Carnivora.
      The largest of the minks, it was hunted to extinction by fur traders before 1903,
      when it was first given a species description. Some biologists classify it as a subspecies of the
      American mink. Estimates of its size are speculative, based largely on skull fragments recovered 
      from Native American shell middens, and on tooth remains. Some information on its appearance and 
      habits was provided by fur traders and Native Americans. It may have been similar in behavior to
      the American mink: it probably maintained home ranges, was polygynandrous, and had a similar diet, 
      supplemented by saltwater prey. Sea minks were commonly trapped along the coast of the Bay of
      Fundy in the Gulf of Maine. Remains have been found along the New England coast, and there were r
      egular reports of unusually large mink furs, probably sea mink, being collected from Nova Scotia</p>
      
      <img  src="data:image/jpeg;base64,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"/>
      </div>
      <button id="showPdf">Generate PDF</button>
<button id="downloadPdf">Download PDF</button>
 



Try this code in your browser for better result.