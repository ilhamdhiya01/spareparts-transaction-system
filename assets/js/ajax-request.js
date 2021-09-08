// Ajax User Menu
$(document).ready(function () {
	readUserMenu();
	readFormUserMenu();
});
// Tampilkan tabel user menu
function readUserMenu() {
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/menu/ambilDataUserMenu",
		type: "get",
		success: function (data) {
			$(".view-user-menu").html(data);
		}
	});
}
// tampilkan form user menu
function readFormUserMenu() {
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/menu/formUserMenu",
		type: "get",
		success: function (data) {
			$(".view-form-user-menu").html(data);
		}
	});
}