<?php
$url = '../../../data/tmp/membercard/files/';
include '../../../include/all_include.php';
$maintenance = false;
?>
<!DOCTYPE html>
<html class="h-full light" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en"
  data-kt-theme-swtich-initialized="true" data-kt-theme-switch-mode="light">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>
    CBS Indo
  </title>
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
  <meta content="en_US" property="og:locale">
  <meta content="website" property="og:type">


  <link href="<?php echo $url; ?>styles.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-lite@5.3.3/dist/css/bootstrap-lite.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $url; ?>bootstrap-custom.css">
</head>

<body
  class="antialiased flex h-full text-base text-foreground bg-background text-foreground bg-background flex h-full text-base">

  <script>
    const defaultThemeMode = 'light'; // light|dark|system
    let themeMode;

    if (document.documentElement) {
      if (localStorage.getItem('kt-theme')) {
        themeMode = localStorage.getItem('kt-theme');
      } else if (
        document.documentElement.hasAttribute('data-kt-theme-mode')
      ) {
        themeMode =
          document.documentElement.getAttribute('data-kt-theme-mode');
      } else {
        themeMode = defaultThemeMode;
      }

      if (themeMode === 'system') {
        themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ?
          'dark' :
          'light';
      }

      document.documentElement.classList.add(themeMode);
    }
  </script>

  <div class="flex grow" id="root">
    <!-- Wrapper -->
    <div class="flex grow"
      style="--sidebar-width: 300px; --sidebar-collapsed-width: 60px; --header-height: 60px; --toolbar-height: 54px; --sidebar-header-height: 54px; --header-height-mobile: 60px;">
      <header
        class="flex items-stretch fixed z-10 top-0 start-0 end-0 shrink-0 bg-background/95 border-b border-border backdrop-blur-sm supports-backdrop-filter:bg-background/60 h-(--header-height-mobile) lg:h-(--header-height) pe-[var(--removed-body-scroll-bar-size,0px)]"
        style="background-color: white;">
        <div class="@container grow pe-5 flex items-stretch justify-between gap-2.5" style="background-color: red;color: white;">
          <div class="flex items-stretch gap-x-6">
            <div class="flex border-e border-border items-center gap-2 lg:w-(--sidebar-width)">
              <div class="flex items-center w-full">
                <div
                  class="flex items-center justify-center shrink-0 border-e border-border w-(--sidebar-collapsed-width) h-(--header-height) bg-muted">
                  <a data-discover="true" href="<?php echo $url; ?>#">
                    <img alt="Thunder AI Logo" class="dark:hidden min-h-[30px]" src="<?php echo $url; ?>logo.png"
                      style="width: 36px;">
                    <img alt="Thunder AI Logo" class="hidden dark:block min-h-[30px]" src="<?php echo $url; ?>logo.png"
                      style="width: 36px;">
                  </a>
                </div>
                <div class="flex w-full grow items-center justify-between px-5 gap-2.5">
                  <button class="kt-btn kt-btn-ghost lg:hidden" data-kt-drawer-toggle="#sidebar">
                    <i style="font-size: 20px;" class="fas fa-bars"></i>


                  </button>
                  <button aria-expanded="false" aria-haspopup="menu"
                    class="cursor-pointer group focus-visible:outline-hidden items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 hover:bg-accent data-[state=open]:bg-accent data-[state=open]:text-accent-foreground h-8.5 rounded-md gap-1.5 text-[0.8125rem] leading-(--text-sm--line-height) [&amp;_svg:not([class*=size-])]:size-4 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 select-none inline-flex text-muted-foreground hover:text-foreground px-1.5 -ms-1.5"
                    data-slot="dropdown-menu-trigger" data-state="closed" id="radix-«r0»" type="button">
                    <div class="size-6 flex items-center justify-center rounded-md bg-teal-600 text-white">
                      <i class="fas fa-user-gear">
                      </i>
                    </div>
                    <span class="text-mono text-sm font-medium hidden lg:block" style="
    color: white;
    font-weight: bold;
">
                      CRM PT.CBS
                    </span>
                    <i class="fas fa-up-right-from-square"></i>


                  </button>
                  <button onclick="window.location.href = '../home/'" aria-expanded="false" aria-haspopup="menu"
                    class="cursor-pointer group focus-visible:outline-hidden items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 hover:bg-accent data-[state=open]:bg-accent data-[state=open]:text-accent-foreground rounded-md gap-1.5 text-[0.8125rem] leading-(--text-sm--line-height) focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 shrink-0 w-8.5 h-8.5 p-0 [&amp;_svg:not([class*=size-])]:size-4 hidden lg:inline-flex text-muted-foreground hover:text-foreground"
                    data-slot="button">
                    <i class="fas fa-border-none">
                    </i>
                  </button>
                </div>
              </div>
            </div>
            <div class="flex flex-row items-center flex-wrap gap-1 lg:gap-5 mb-5 lg:mb-0 hidden lg:flex">
              <ol class="kt-breadcrumb">

                <li class="kt-breadcrumb-item">
                  <span class="kt-breadcrumb-page" style="color: white;font-weight: bold;">
                    <?php tabelnomin(); ?>
                  </span>
                </li>
              </ol>
            </div>
          </div>
          <nav class="flex items-center gap-2.5">

            <button onclick="kirimWA()" class="kt-btn kt-btn-outline px-2" tooltip data-kt-tooltip-placement='right'
              data-kt-tooltip-trigger='click' type="button">
              <i class="fab fa-medapps"></i>
            </button>

            <script>
              function kirimWA() {
                var pesan = confirm("Jika ada problem bisa diskusi ke nomor 0852-6779-2168.\n\nLanjut buka WhatsApp?");
                if (pesan) {
                  window.open("https://api.whatsapp.com/send?phone=6285267792168&text=CBS-INDO", "_blank");
                }
              }
            </script>



            <button onclick="window.location.href = '../data_persetujuan_point/index.php';" class="kt-btn kt-btn-mono"
              type="button">
              <i class="fas fa-bell">
              </i>
              <span class="hidden lg:block">
                Notification
              </span>
            </button>
            <!-- User Dropdown -->
            <div data-kt-dropdown="true" data-kt-dropdown-offset="10px, 10px" data-kt-dropdown-offset-rtl="-20px, 10px"
              data-kt-dropdown-placement="top-end" data-kt-dropdown-placement-rtl="top-start"
              data-kt-dropdown-trigger="click" data-kt-dropdown-initialized="true">
              <div class="cursor-pointer shrink-0" data-kt-dropdown-toggle="true">
                <link as="image" href="<?php echo $url; ?>300-2.png" rel="preload">
                <div class="kt-avatar size-7">
                  <div class="kt-avatar-image">
                    <img alt="avatar" src="<?php echo $url; ?>300-2.png">

                  </div>
                  <div class="kt-avatar-indicator -end-1.5 -top-1.5">
                    <div class="kt-avatar-status kt-avatar-status-online size-2.5">
                    </div>
                  </div>
                </div>
              </div>

              <div class="kt-dropdown-menu w-[250px]" data-kt-dropdown-menu="true">
                <div class="flex items-center justify-between px-2.5 py-1.5 gap-1.5">
                  <div class="flex items-center gap-2">
                    <link as="image" href="<?php echo $url; ?>300-2.png" rel="preload">
                    <div class="kt-avatar">
                      <div class="kt-avatar-image">
                        <img alt="avatar" src="<?php echo $url; ?>300-2.png">

                      </div>
                      <div class="kt-avatar-indicator -end-1.5 -top-1.5">
                        <div class="kt-avatar-status kt-avatar-status-online size-2.5">
                        </div>
                      </div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                      <span class="text-sm text-foreground font-semibold leading-none">
                        Administrator
                      </span>
                      <span class="text-xs text-secondary-foreground leading-none">
                        Online
                      </span>
                    </div>
                  </div>
                </div>

                <div class="px-2.5 pt-1.5 mb-2.5 flex flex-col gap-3.5">
                  <div class="flex items-center gap-2 justify-between">
                    <span class="flex items-center gap-2">

                    </span>

                  </div>
                  <a href="<?php logout(); ?>" class="kt-btn kt-btn-outline justify-center w-full">
                    Log out
                  </a>
                </div>
              </div>
            </div>
            <!-- End of User Dropdown -->
          </nav>
        </div>
      </header>
      <aside
        class="fixed overflow-hidden top-(--header-height) start-0 z-20 transition-all duration-300 flex items-stretch flex-shrink-0 w-(--sidebar-width) in-data-[sidebar-open=false]:w-(--sidebar-collapsed-width) border-e border-border [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]"
        data-kt-drawer="true" data-kt-drawer-class="kt-drawer kt-drawer-start top-0 bottom-0" id="sidebar"
        data-kt-drawer-initialized="true">







        <div x-data="{ active: 'dashboard' }" class="flex">

          <!-- Desktop Collapsed Sidebar (visible on desktop) -->
          <div
            class="flex flex-col items-center justify-center shrink-0 py-2.5 gap-5 lg:w-(--sidebar-collapsed-width) border-e border-input bg-muted hidden lg:flex">
            <div class="relative overflow-hidden grow w-full h-[calc(100vh-10rem)] lg:h-[calc(100vh-5.5rem)]"
              data-slot="scroll-area" dir="ltr"
              style="position: relative; --radix-scroll-area-corner-width: 0px; --radix-scroll-area-corner-height: 0px;">
              <div class="h-full w-full rounded-[inherit]">
                <div style="min-width: 100%; display: table;">
                  <div class="grow gap-1 shrink-0 flex items-center flex-col gap-3">

                    <!-- Dashboard -->
                    <a @click="active = 'dashboard'"
                      :class="active === 'dashboard' ? 'kt-btn-mono active' : 'kt-btn-ghost'" class="kt-btn kt-btn-icon"
                      style="color: white;" data-kt-tooltip="true" data-kt-tooltip-placement="right">
                      <i style="font-size: 20px;" class="fab fa-delicious"></i>
                      <span class="kt-tooltip" data-kt-tooltip-content="true">Dashboard</span>
                    </a>

                    <!-- Master Data -->
                    <a @click="active = 'masterdata'"
                      :class="active === 'masterdata' ? 'kt-btn-mono active' : 'kt-btn-ghost'"
                      class="kt-btn kt-btn-icon" data-kt-tooltip="true" data-kt-tooltip-placement="right">
                      <i style="font-size: 20px;" class="fas fa-file-lines"></i>
                      <span class="kt-tooltip" data-kt-tooltip-content="true">Master Data</span>
                    </a>

                    <!-- Pengaturan -->
                    <a @click="active = 'pengaturan'"
                      :class="active === 'pengaturan' ? 'kt-btn-mono active' : 'kt-btn-ghost'"
                      class="kt-btn kt-btn-icon" data-kt-tooltip="true" data-kt-tooltip-placement="right">
                      <i style="font-size: 20px;" class="fas fa-gears"></i>
                      <span class="kt-tooltip" data-kt-tooltip-content="true">Pengaturan</span>
                    </a>

                    <!-- Backup Restore -->
                    <a @click="active = 'backup'" :class="active === 'backup' ? 'kt-btn-mono active' : 'kt-btn-ghost'"
                      class="kt-btn kt-btn-icon" data-kt-tooltip="true" data-kt-tooltip-placement="right">
                      <i style="font-size: 20px;" class="fas fa-database"></i>
                      <span class="kt-tooltip" data-kt-tooltip-content="true">Backup Restore</span>
                    </a>

                    <!-- Laporan -->
                    <a @click="active = 'laporan'" :class="active === 'laporan' ? 'kt-btn-mono active' : 'kt-btn-ghost'"
                      class="kt-btn kt-btn-icon" data-kt-tooltip="true" data-kt-tooltip-placement="right">
                      <i style="font-size: 20px;" class="fas fa-chart-column"></i>
                      <span class="kt-tooltip" data-kt-tooltip-content="true">Laporan</span>
                    </a>

                  </div>
                </div>
              </div>
            </div>

            <!-- Bagian bawah collapsed (messages, notepad, setting) -->
            <div class="flex flex-col items-center gap-2.5 shrink-0">
              <a class="kt-btn kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-messages"></i></a>
              <a class="kt-btn kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-notepad"></i></a>
              <a class="kt-btn kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-setting"></i></a>
            </div>
          </div>

          <!-- Sidebar Menu Content (yang berubah sesuai menu) -->
          <div class="flex flex-col grow in-data-[sidebar-open=false]:hidden">
            <div class="flex flex-col grow space-y-7.5">
              <div class="kt-accordion" data-kt-accordion="true" data-kt-accordion-expand-all="true">

                <!-- ===================== DASHBOARD ===================== -->
                <div x-show="active === 'dashboard'">
                  <!-- Isi Dashboard (yang sudah ada) -->
                  <!-- Sidebar Menu -->

                  <div class="kt-accordion" data-kt-accordion="true" data-kt-accordion-expand-all="true"
                    data-kt-accordion-initialized="true">
                    <!-- General Section -->
                    <div class="kt-accordion-item active" data-kt-accordion-item="true">
                      <div class="flex px-3 .5 pb-4 shrink-0 pt-3">
                        <form action="../data_member/index.php">
                          <div class="kt-input">
                            <input type="hidden" name="Berdasarkan" value="nama">
                            <input class="kt-input" placeholder="Search Member" name="isi" type="text">
                            <span class="kt-badge kt-badge-stroke">
                              ⌘ Go
                            </span>
                          </div>
                        </form>
                      </div>

                      <div class="space-y-2">
                        <div class="flex items-center gap-1.5 px-0.5">
                          <span class="kt-accordion-title">
                            <div class="px-2 text-xs font-normal text-muted-foreground">
                              Dashboard
                            </div>
                          </span>
                        </div>
                        <div class="grid grid-cols-2 p-3 gap-2">

                          <button onclick="window.location.href='../home/index.php'" data-slot="button"
                            style="height: 95px;"
                            class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="40px" src="<?php echo $url; ?>icon/dashboard2.png">
                            <span class="text-xs leading-tight ">Dashboard</span>
                          </button>

                          <button onclick="window.location.href='../data_member/index.php?input=tambah'"
                            data-slot="button" style="height: 95px;"
                            class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="40px" src="<?php echo $url; ?>icon/register.png">
                            <span class="text-xs leading-tight ">Pendaftaran</span>
                          </button>


                          <button onclick="window.location.href='../data_member/index.php'" data-slot="button"
                            style="height: 95px;"
                            class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="40px" src="<?php echo $url; ?>icon/member2.png">
                            <span class="text-xs leading-tight ">Member</span>
                          </button>

                          <button onclick="window.location.href='../data_transaksi/index.php'" data-slot="button"
                            style="height: 95px;"
                            class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="50px" src="<?php echo $url; ?>icon/transaksi.png">
                            <span class="text-xs leading-tight ">Transaksi</span>
                          </button>


                          <button onclick="window.location.href='../data_redeem/index.php'" data-slot="button"
                            style="height: 95px;"
                            class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="45px" src="<?php echo $url; ?>icon/redeem.png">
                            <span class="text-xs leading-tight ">Redeem</span>
                          </button>

                          <button onclick="window.location.href='../data_list_mitra/index.php'" data-slot="button"
                            style="height: 95px;"
                            class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="45px" src="<?php echo $url; ?>icon/promo.png">
                            <span class="text-xs leading-tight ">Promo</span>
                          </button>


                          <!-- <button onclick="window.location.href='../data_mitra/index.php'" data-slot="button" style="height: 95px;" class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="45px" src="<?php echo $url; ?>icon/mitra2.png">
                            <span class="text-xs leading-tight ">Mitra</span>
                          </button> -->

                          <button onclick="window.location.href='../data_grafik/index.php'" data-slot="button"
                            style="height: 95px;"
                            class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="45px" src="<?php echo $url; ?>icon/report.png">
                            <span class="text-xs leading-tight ">Grafik</span>
                          </button>

                          <button onclick="window.location.href='../backuprestore/index.php'" data-slot="button"
                            style="height: 95px;"
                            class="cursor-pointer group focus-visible:outline-hidden inline-flex items-center justify-center has-data-[arrow=true]:justify-between whitespace-nowrap font-medium ring-offset-background transition-[color,box-shadow] disabled:pointer-events-none disabled:opacity-60 [&amp;_svg]:shrink-0 bg-background text-accent-foreground border border-input hover:bg-accent data-[state=open]:bg-accent rounded-md px-2.5 text-xs [&amp;_svg:not([class*=size-])]:size-3.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg:not([role=img]):not([class*=text-]):not([class*=opacity-])]:opacity-60 h-auto min-h-7 shadow-xs shadow-black/5 flex-col gap-1 py-2">
                            <img width="40px" src="<?php echo $url; ?>icon/database.png">
                            <span class="text-xs leading-tight ">Backup</span>
                          </button>


                        </div>


                        <!-- Custom Feed Section -->
                        <div class="kt-accordion-item active" data-kt-accordion-item="true">
                          <button aria-controls="accordion_content_1" class="kt-accordion-toggle px-3"
                            data-kt-accordion-toggle="true" id="accordion_toggle_1">
                            <span class="kt-accordion-title">
                              <div class="px-2 text-xs font-normal text-muted-foreground">
                                Account
                              </div>
                            </span>
                            <span aria-hidden="true" class="kt-accordion-indicator">
                              <svg aria-hidden="true" class="lucide lucide-plus kt-accordion-indicator-on" fill="none"
                                height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12h14">
                                </path>
                                <path d="M12 5v14">
                                </path>
                              </svg>
                              <svg aria-hidden="true" class="lucide lucide-minus kt-accordion-indicator-off" fill="none"
                                height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12h14">
                                </path>
                              </svg>
                            </span>
                          </button>
                          <div aria-labelledby="accordion_toggle_1" class="kt-accordion-content"
                            id="accordion_content_1">
                            <div class="kt-accordion-wrapper">
                              <ul class="kt-accordion-menu gap-px" data-kt-accordion="true"
                                data-kt-accordion-initialized="true">
                                <li class="kt-accordion-menu-item w-full space-y-7.5 px-2.5"
                                  data-kt-accordion-item="true">
                                  <a href="../password/index.php?input=edit"
                                    class="kt-accordion-menu-link kt-accordion-selected:text-muted-foreground text-sm font-normal h-8.5 px-2.5">
                                    <i class="fas fa-gear">
                                    </i>
                                    Ganti Password
                                  </a>
                                </li>
                                <li class="kt-accordion-menu-item w-full space-y-7.5 px-2.5"
                                  data-kt-accordion-item="true">
                                  <a href="<?php logout(); ?>"
                                    class="kt-accordion-menu-link kt-accordion-selected:text-muted-foreground text-sm font-normal h-8.5 px-2.5">
                                    <i class="fas fa-lock">
                                    </i>
                                    Logout
                                  </a>
                                </li>

                              </ul>
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>

                  </div>

                  <!-- End of Sidebar Menu -->
                </div>

                <!-- ===================== MASTER DATA ===================== -->
                <div x-show="active === 'masterdata'">
                  <div class="kt-accordion" data-kt-accordion="true" data-kt-accordion-expand-all="true"
                    data-kt-accordion-initialized="true">
                    <div class="space-y-2" style="padding-top: 14px;">
                      <div class="flex items-center gap-1.5 px-0.5">
                        <span class="kt-accordion-title">
                          <div class="px-2 text-xs font-normal text-muted-foreground">Master Data</div>
                        </span>
                      </div>
                      <div class="pt-4 space-y-2">
                        <ul class="kt-accordion-menu gap-px" data-kt-accordion="true"
                          data-kt-accordion-initialized="true">

                          <?php
                          $m = new SimpleXMLElement('../../../include/settings/menu.xml', null, true);
                          foreach ($m as $i) {
                            if ($i->t == 's') {
                              ?>
                              <li class="kt-accordion-menu-item w-full space-y-7.5 px-2.5" data-kt-accordion-item="true">
                                <a href="<?php echo $i->l; ?>"
                                  class="kt-accordion-menu-link kt-accordion-selected:text-muted-foreground text-sm font-normal h-8.5 px-2.5">
                                  <i class="<?php echo $i->i; ?>"></i>
                                  </i>
                                  <?php echo $i->n; ?>
                                </a>
                              </li>

                              <?php
                            }
                          }
                          ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ===================== PENGATURAN ===================== -->
                <div x-show="active === 'pengaturan'">
                  <div class="kt-accordion-item active">
                    <div class="space-y-2" style="
    padding-top: 14px;
">
                      <div class="flex items-center gap-1.5 px-0.5">
                        <span class="kt-accordion-title">
                          <div class="px-2 text-xs font-normal text-muted-foreground">Pengaturan</div>
                        </span>
                      </div>
                      <div class="pt-4 space-y-2">
                        <ul class="kt-accordion-menu gap-px" data-kt-accordion="true"
                          data-kt-accordion-initialized="true">
                          <?php
                          $m = new SimpleXMLElement('../../../include/settings/pengaturan.xml', null, true);
                          foreach ($m as $i) {
                            if ($i->t == 's') {
                              ?>
                              <li class="kt-accordion-menu-item w-full space-y-7.5 px-2.5" data-kt-accordion-item="true"><a
                                  class="kt-accordion-menu-link kt-accordion-selected:text-muted-foreground text-sm font-normal h-8.5 px-2.5"
                                  href="<?php echo $i->l; ?>"><i class="<?php echo $i->i; ?>"></i> <?php echo $i->n; ?></a>
                              </li>

                              <?php
                            }
                          }

                          ?>
                          <?php if ($hak_akses == "manager") { ?>
                            <li class="kt-accordion-menu-item w-full space-y-7.5 px-2.5" data-kt-accordion-item="true"><a
                                class="kt-accordion-menu-link kt-accordion-selected:text-muted-foreground text-sm font-normal h-8.5 px-2.5"
                                href="../data_persetujuan_point/index.php"><i class="fa fa-cog"></i> Persetujuan Point</a>
                            </li>
                          <?php } ?>

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ===================== BACKUP RESTORE ===================== -->
                <div x-show="active === 'backup'">
                  <div class="kt-accordion-item active">
                    <div class="space-y-2" style="padding-top: 14px;">
                      <div class="flex items-center gap-1.5 px-0.5">
                        <span class="kt-accordion-title">
                          <div class="px-2 text-xs font-normal text-muted-foreground">Backup Restore</div>
                        </span>
                      </div>
                      <div class="pt-4 space-y-2">
                        <ul class="kt-accordion-menu gap-px" data-kt-accordion="true"
                          data-kt-accordion-initialized="true">
                          <?php
                          $m = new SimpleXMLElement('../../../include/settings/backuprestore.xml', null, true);
                          foreach ($m as $i) {
                            if ($i->t == 's') {
                              ?>
                              <li class="kt-accordion-menu-item w-full space-y-7.5 px-2.5" data-kt-accordion-item="true"><a
                                  class="kt-accordion-menu-link kt-accordion-selected:text-muted-foreground text-sm font-normal h-8.5 px-2.5"
                                  href="../backuprestore/<?php echo $i->l; ?>"><i class="<?php echo $i->i; ?>"></i>
                                  <?php echo $i->n; ?></a></li>
                              <?php
                            }
                          }
                          ?>

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ===================== LAPORAN ===================== -->
                <div x-show="active === 'laporan'">
                  <div class="kt-accordion-item active">
                    <div class="space-y-2" style="
    padding-top: 14px;
">
                      <div class="flex items-center gap-1.5 px-0.5">
                        <span class="kt-accordion-title">
                          <div class="px-2 text-xs font-normal text-muted-foreground">Laporan</div>
                        </span>
                      </div>
                      <div class="pt-4 space-y-2">
                        <ul class="kt-accordion-menu gap-px" data-kt-accordion="true"
                          data-kt-accordion-initialized="true">
                          <?php
                          $m = new SimpleXMLElement('../../../include/settings/laporan.xml', null, true);
                          foreach ($m as $i) {
                            if ($i->t == 's') {
                              ?>
                              <li class="kt-accordion-menu-item w-full space-y-7.5 px-2.5" data-kt-accordion-item="true"><a
                                  class="kt-accordion-menu-link kt-accordion-selected:text-muted-foreground text-sm font-normal h-8.5 px-2.5"
                                  href="<?php echo $i->l; ?>"><i class="<?php echo $i->i; ?>"></i> <?php echo $i->n; ?></a>
                              </li>
                              <?php
                            }
                          }
                          ?>

                        </ul>
                      </div>
                    </div>
                  </div>



                </div>
              </div>
            </div>
          </div>



      </aside>
      <div
        class="5 grow overflow-y-auto pt-(--header-height-mobile) lg:ps-(--sidebar-width) lg:in-data-[sidebar-open=false]:ps-(--sidebar-collapsed-width) transition-all duration-300">
        <!-- <div class="py-2.5 lg:py-0  start-[calc(var(--sidebar-width))] lg:in-data-[sidebar-open=false]:start-[calc(var(--sidebar-collapsed-width))] transition-all duration-300 end-0 z-10 px-5 flex flex-wrap items-center justify-between gap-2.5 min-h-(--toolbar-height) bg-background border-b border-border shrink-0">
          <div class="flex flex-col md:flex-row md:items-center flex-wrap gap-1 lg:gap-5">
            <div class="flex items-stretch">
              <nav class="list-none flex items-stretch gap-1">
                <a class="kt-btn kt-btn-ghost" data-discover="true" data-slot="button">
                  <i class="fas fa-house-user">
                  </i>
                  Home
                </a>
                <a class="kt-btn kt-btn-ghost" data-discover="true" data-slot="button">
                  <i class="fas fa-angle-right">
                  </i>
                  Halaman
                </a>
                <a class="kt-btn kt-btn-ghost" data-discover="true" data-slot="button">
                  <i class="fas fa-angle-right">
                  </i>
                  Data Pendaftaran
                </a>

              </nav>
            </div>
          </div>
          <div class="flex items-center gap-2.5">

            <button class="kt-btn kt-btn-outline kt-btn-sm" data-slot="button">
              <i class="fas fa-magnifying-glass">
              </i>
              Pencarian
            </button>

          </div>
        </div> -->




        <main class="grow p-5 bg-accent" style="min-height:100%" role="content">
          <div class="bg-white rounded-lg p-5 ">
            <?php include 'halaman.php';
            ?>
          </div>
        </main>



      </div>
    </div>
  </div>


  <script src="<?php echo $url; ?>ktui.min.js">
  </script>


</body>

</html>