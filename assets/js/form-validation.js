function addCustomerValidation() {
	const nama = $("#nama_customer").val();
	const no_tlp = $("#no_tlp").val();
	const nik = $("#nik").val();
	const alamat = $("#alamat").val();

	// cek apakah nik sudah digunakan atau belum
	$.ajax({
		url: "http://localhost/spareparts-transaction-system/service/get_nik",
		type: "post",
		data: {
			nik: nik,
		},
		dataType: "json",
		success: function (data) {
			if (data == null) {
				return data;
			} else {
				if (data.nik == nik) {
					$("#nik").removeClass("is-invalid").addClass("is-invalid");
					$(".nik_customer_error").html("NIK sudah digunakan");
				} else {
					$("#nik").removeClass("is-invalid");
					$(".nik_customer_error").html("");
				}
			}
		},
	});
	// nama cusstomer
	if (nama == "" || nama == undefined) {
		$("#nama_customer").addClass("is-invalid");
		$(".nama_customer_error").html("Nama customer wajib di isi");
		bool = false;
	} else {
		$("#nama_customer").removeClass("is-invalid");
		$(".nama_customer_error").html("");
		bool = true;
	}

	// no_tlp customer
	if (no_tlp == "" || no_tlp == undefined) {
		$("#no_tlp").addClass("is-invalid");
		$(".no_tlp_customer_error").html("No HP/WA wajib di isi");
		bool = false;
	} else {
		$("#no_tlp").removeClass("is-invalid");
		$(".no_tlp_customer_error").html("");
	}

	// nik customer
	if (nik == "" || nik == undefined) {
		$("#nik").addClass("is-invalid");
		$(".nik_customer_error").html("NIK wajib di isi");
		bool = false;
	} else if (nik.length != 16) {
		$("#nik").removeClass("is-invalid").addClass("is-invalid");
		$(".nik_customer_error").html("NIK wajib 16 digit");
		bool = false;
	} else {
		$("#nik").removeClass("is-invalid");
		$(".nik_customer_error").html("");
		bool = true;
	}

	// alamat customer
	if (alamat == "" || alamat == undefined) {
		$("#alamat").addClass("is-invalid");
		$(".alamat_customer_error").html("Alamat wajib di isi");
		bool = false;
	} else {
		$("#alamat").removeClass("is-invalid");
		$(".alamat_customer_error").html("");
		// bool = true;
	}
	return bool;
}
