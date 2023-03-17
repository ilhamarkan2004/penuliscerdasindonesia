<body>
  <nav id="nav" class="relative z-50 w-full top-0 left-0 border" style="position: fixed; background-color: rgba(255, 255, 255, 0.9);">
    <div class=" w-full text-white">

      <div class="absolute z-50 shadow-md ml-0 md:ml-20 md:top-0 shadow-primary-100 rounded-b-xl bg-white p-4 lg:p-4">
        <img src="<?= base_url('assets/assets/logo/logo.jpeg') ?>" class="w-14 h-14" alt="">
      </div>

    </div>
    <div class="w-100 bg-transparent text-primary-100 font-medium">
      <div class="md:hidden relative">
        <div class="bg-primary-200 text-white block h-14 ">
          <div id="nav_toggle" onclick="setNavOpen(!getNavOpen())" class="ml-auto w-14 h-14 p-4 flex flex-col items-center justify-center gap-2">
            <span class="block h-1 w-full rounded-full bg-white transition duration-300"></span>
            <span class="block h-1 w-full rounded-full bg-white transition duration-200"></span>
            <span class="block h-1 w-full rounded-full bg-white transition duration-300"></span>
          </div>
          <div id="nav_menu" class="absolute hidden top-full w-full left-0 cursor-pointer">
            <div class="flex flex-col text-start bg-primary-200">
              <a href="<?= site_url() ?>" class="px-4 pt-5 w-full mt-10 text-white">Home</a>


              <!-- START DROP PROGRAM -->
              <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
              <div class="w-full mt-2">
                <div :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow">
                  <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <a @click="open = !open" class="flex flex-row items-center w-full px-4 text-sm text-left bg-transparent rounded-lg">
                      <span class="text-[14px] hover:opacity-75">Acara</span>
                      <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-6 h-6 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                      </svg>
                    </a>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class=" right-0 w-full mt-2 origin-top-right rounded-md">

                      <?php foreach ($event as $e) : ?>
                        <li class="list-program bg-white text-black px-3 py-1"><a href="<?= base_url() ?>pci/event/<?= $e['inisial'] ?>"><?= $e['name_type'] ?></a></li>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>

              <!-- END DROP PROGRAM -->

              <a class="px-4 mt-2 w-full hover:opacity-75" href="<?= base_url() ?>pci/terbit" class="p-2.5 text-blog">Terbitkan buku</a>
              <!-- <a class="px-4 mt-2 w-full hover:opacity-75" href="#contact" class="p-2.5">Contact</a> -->
              <a class="px-4 py-2 mt-2 w-[97%] text-center rounded-lg mb-2 self-center border-white border" href="<?= ($this->session->has_userdata('id_user') ? base_url('dashboard') : base_url('auth')) ?>"><?= ($this->session->has_userdata('id_user') ? 'Dashboard' : 'Login') ?></a>
            </div>
          </div>
        </div>
      </div>
      <div class="my-container hidden md:flex py-3 gap-5 xl:gap-16 h-[84px] justify-end items-center">
        <div class="flex flex-row items-center gap-2 xl:gap-5">

          <a href="<?= site_url() ?>" class="p-2.5 relative text-blog">
            Home
            <!-- <span class="rounded absolute block h-1 w-full bg-secondary-100 left-0 top-15"></span> -->
          </a>


          <!-- STYLE LIST PROGRAM -->
          <style>
            .group:hover .group-hover\:scale-100 {
              transform: scale(1)
            }

            .group:hover .group-hover\:-rotate-180 {
              transform: rotate(180deg)
            }

            .scale-0 {
              transform: scale(0)
            }

            .min-w-32 {
              min-width: 8rem
            }

            #scroll-program::-webkit-scrollbar-track {
              background-color: #eeeeee;
              border-top-left-radius: 0;
              border-top-right-radius: 10px;
            }

            #scroll-program::-webkit-scrollbar {
              width: 12px;
              height: 15px;
              border-top-left-radius: 0;
            }

            #scroll-program::-webkit-scrollbar-thumb {
              border-top-right-radius: 10px;

              background-color: #1DACD9;
              background-image: -webkit-linear-gradient(top,
                  #e4f5fc 0%,
                  #bfe8f9 50%,
                  #9fd8ef 51%,
                  #2ab0ed 100%);

            }

            #scroll-program {
              border-radius: 10px;
              transition: all 0.3s ease;
              max-height: 160px;
            }

            .list-program:hover {
              background-color: #FE8F1D;
              transition: all 0.1s ease;
            }
          </style>
          <div style="">
            <div class="flex">
              <div class="group inline-block">
                <button class="outline-none focus:outline-none px-3 py-1 rounded-sm flex items-center ">
                  <span class="pr-1 text-blog">Acara</span>
                  <span>
                    <svg style="fill: white" class="fill-current h-4 w-4 transform group-hover:-rotate-180
                          transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                  </span>
                </button>
                <ul id="scroll-program" class="shadow-lg overflow-auto border-white transform scale-0 group-hover:scale-100 absolute transition duration-250 ease-in-out origin-top min-w-32">
                  <!-- <li class="bg-white rounded-sm text-black px-3 py-1 hover:bg-orange-400">Programming</li>
                  <li class="bg-white rounded-sm text-black px-3 py-1 hover:bg-orange-400">DevOps</li> -->

                  <?php foreach ($event as $e) : ?>
                    <li class="list-program bg-white text-black px-3 py-1"><a href="<?= base_url() ?>pci/event/<?= $e['inisial'] ?>"><?= $e['name_type'] ?></a></li>
                  <?php endforeach; ?>

                </ul>
              </div>
            </div>
          </div>
          <!-- <a href="#" class="p-2.5 ">AMD for Corporate</a>
          <a href="#" class="p-2.5">About</a> -->
          <a href="<?= base_url() ?>terbit" class="p-2.5 text-blog" style="z-index: 9;">Terbitkan buku</a>
          <!-- <a href="" class="p-2.5 text-kontak">Contact</a> -->
        </div>
        <div class="flex flex-row items-center font-semibold gap-4">
          <a href="<?= ($this->session->has_userdata('id_user') ? base_url('dashboard') : base_url('auth')) ?>" class="px-6 xl:px-12 py-2 xl:py-3 rounded-lg border lg:border-primaryBtn bg-primary-200 hover:bg-white text-white hover:text-primaryBtn">
            <?= ($this->session->has_userdata('id_user') ? 'Dashboard' : 'Login') ?>

          </a>
        </div>
      </div>
    </div>
  </nav>