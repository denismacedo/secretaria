

function chamaPopup(endereco,largura,altura,posicaoX,posicaoY, menubar){
	if (menubar) {
		menubar = 1;
	} else {
		menubar = 0;
	}
	mywindow = window.open(endereco,"","resizable=1,location=0,menubar=yes,status=1,scrollbars=1,width=" + largura + ",height=" + altura);
	mywindow.moveTo(posicaoX,posicaoY);
	mywindow.opener = window;
	return mywindow;
}




