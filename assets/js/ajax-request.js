$(document).ready(function () {
	// user menu
	readUserMenu();
	readFormUserMenu();
	// sub menu
	readSubMenu();
	readFormSubMenu();
	// access menu
	readAccessMenu();
	readFormAccessMenu();
	// dropdown menu
	// readDropdownMenu();
});
// Ajax User Menu
// Tampilkan tabel user menu
function readUserMenu() {
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/menu/ambilDataUserMenu",
		type: "get",
		success: function (data) {
			$(".view-user-menu").html(data);
		},
	});
}
// tampilkan form user menu
function readFormUserMenu() {
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/menu/formUserMenu",
		type: "get",
		success: function (data) {
			$(".view-form-user-menu").html(data);
		},
	});
}

// Ajax request Sub menu
function readSubMenu() {
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/menu/ambilDataSubMenu",
		type: "get",
		success: function (data) {
			$("#view-sub-menu").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
		},
	});
}

function readFormSubMenu() {
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/menu/formSubMenu",
		type: "get",
		success: function (data) {
			$(".view-form-sub-menu").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
		},
	});
}

// ajax request access menu
function readAccessMenu() {
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/menu/ambilDataAccessMenu",
		type: "get",
		success: function (data) {
			$(".view-access-menu").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
		},
	});
}

// load form user access menu
function readFormAccessMenu() {
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/menu/formAccessMenu",
		type: "get",
		success: function (data) {
			$(".view-form-access-menu").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
		},
	});
}
