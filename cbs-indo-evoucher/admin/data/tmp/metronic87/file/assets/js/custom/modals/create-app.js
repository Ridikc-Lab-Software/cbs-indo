"use strict";
var KTCreateApp = (function () {
  var e,
    t,
    o,
    r,
    a,
    i,
    n = [];
  return {
    init: function () {
      (e = document.querySelector("#buat_e_voucher")) &&
        (new bootstrap.Modal(e),
        (t = document.querySelector("#buat_e_voucher_stepper")),
        (o = document.querySelector("#buat_e_voucher_form")),
        (r = t.querySelector('[data-kt-stepper-action="submit"]')),
        (a = t.querySelector('[data-kt-stepper-action="next"]')),
        (i = new KTStepper(t)).on("kt.stepper.changed", function (e) {
          4 === i.getCurrentStepIndex()
            ? (r.classList.remove("d-none"),
              r.classList.add("d-inline-block"),
              a.classList.add("d-none"))
            : 5 === i.getCurrentStepIndex()
            ? (r.classList.add("d-none"), a.classList.add("d-none"))
            : (r.classList.remove("d-inline-block"),
              r.classList.remove("d-none"),
              a.classList.remove("d-none"));
        }),
        i.on("kt.stepper.next", function (e) {
          console.log("stepper.next");
          var t = n[e.getCurrentStepIndex() - 1];
          t
            ? t.validate().then(function (t) {
                console.log("validated!"),
                  "Valid" == t
                    ? e.goNext()
                    : Swal.fire({
                        text: "Silahkan pilih nama relasi untuk melanjutkan ke proses selanjutnya.",
                        icon: "warning",
                        buttonsStyling: !1,
                        confirmButtonText: "Oke, Saya mengerti",
                        customClass: {
                          confirmButton: "btn btn-light",
                        },
                      }).then(function () {});
              })
            : (e.goNext(), KTUtil.scrollTop());
        }),
        i.on("kt.stepper.previous", function (e) {
          console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop();
        }),
        r.addEventListener("click", function (e) {
          n[3].validate().then(function (t) {
            console.log("validated!"),
              "Valid" == t
                ? (e.preventDefault(),
                  (r.disabled = !0),
                  r.setAttribute("data-kt-indicator", "on"),
                  setTimeout(function () {
                    r.removeAttribute("data-kt-indicator"),
                      (r.disabled = !1),
                      o.submit();

                    i.goNext();
                  }, 2e3))
                : Swal.fire({
                    text: "Masih ada data yang belum diinputkan di Form silahkan klik back, dan cek kembali form.",
                    icon: "warning",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok,Saya mengerti",
                    customClass: {
                      confirmButton: "btn btn-light",
                    },
                  }).then(function () {
                    KTUtil.scrollTop();
                  });
          });
        }),
        $(o.querySelector('[name="nominal"]')).on("change", function () {
          n[3].revalidateField("nominal");
        }),
        $(o.querySelector('[name="jumlah"]')).on("change", function () {
          n[3].revalidateField("jumlah");
        }),
        n.push(
          FormValidation.formValidation(o, {
            fields: {
              id_relasi: {
                validators: {
                  notEmpty: {
                    message: "<br>Silahkan pilih nama relasi terlebih dahulu",
                  },
                },
              },
            },
            plugins: {
              trigger: new FormValidation.plugins.Trigger(),
              bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: ".fv-row",
                eleInvalidClass: "",
                eleValidClass: "",
              }),
            },
          })
        ),
        n.push(
          FormValidation.formValidation(o, {
            fields: {
              framework: {
                validators: {
                  notEmpty: {
                    message: "Framework is required",
                  },
                },
              },
            },
            plugins: {
              trigger: new FormValidation.plugins.Trigger(),
              bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: ".fv-row",
                eleInvalidClass: "",
                eleValidClass: "",
              }),
            },
          })
        ),
        n.push(
          FormValidation.formValidation(o, {
            fields: {
              dbname: {
                validators: {
                  notEmpty: {
                    message: "Database name is required",
                  },
                },
              },
              dbengine: {
                validators: {
                  notEmpty: {
                    message: "Database engine is required",
                  },
                },
              },
            },
            plugins: {
              trigger: new FormValidation.plugins.Trigger(),
              bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: ".fv-row",
                eleInvalidClass: "",
                eleValidClass: "",
              }),
            },
          })
        ),
        n.push(
          FormValidation.formValidation(o, {
            fields: {
              spbu: {
                validators: {
                  notEmpty: {
                    message: "Silahkan input Nama SPBU",
                  },
                },
              },
              nominal: {
                validators: {
                  notEmpty: {
                    message: "Silahkan input nominal",
                  },
                },
              },
              jumlah: {
                validators: {
                  notEmpty: {
                    message: "Silahkan input jumlah",
                  },
                },
              },
            },
            plugins: {
              trigger: new FormValidation.plugins.Trigger(),
              bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: ".fv-row",
                eleInvalidClass: "",
                eleValidClass: "",
              }),
            },
          })
        ));
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  KTCreateApp.init();
});
