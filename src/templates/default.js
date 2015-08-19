function loading() {
	var loading = document.getElementById("divCarregando");
	loading.style.visibility = "VISIBLE";
	loading.style.display = "";
	loading.style.MozOpacity=.7; // transparencia FF
	loading.style.opacity=.7; // transparencia  FF, Opera, Safari, Netscape
	loading.style.filter="Alpha(Opacity=70)";
}