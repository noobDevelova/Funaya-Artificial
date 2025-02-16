function data() {
  function getThemeFromLocalStorage() {
    if (window.localStorage.getItem("dark")) {
      return JSON.parse(window.localStorage.getItem("dark"));
    }
    return (
      !!window.matchMedia &&
      window.matchMedia("(prefers-color-scheme: dark)").matches
    );
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem("dark", value);
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark;
      setThemeToLocalStorage(this.dark);
      this.applyTheme();
    },
    applyTheme() {
      if (this.dark) {
        document.documentElement.setAttribute("data-mode", "dark");
      } else {
        document.documentElement.removeAttribute("data-mode");
      }
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen;
    },
    closeSideMenu() {
      this.isSideMenuOpen = false;
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false;
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen;
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false;
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen;
    },

    // Modal Confirm State
    isModalConfirmOpen: false,
    isModalConfirmLoading: false,
    modalConfirmData: {
      title: "",
      description: "",
      confirmAction: null,
      additionalData: {},
    },
    trapConfirmCleanup: null,

    isModalOpen: false,
    isModalLoading: false,
    modalData: {
      title: "",
      description: "",
      confirmAction: null,
      additionalData: {},
      loadAction: null,
    },

    trapCleanup: null,

    openModal({
      title,
      description,
      confirmAction,
      additionalData = {},
      loadAction = null,
    }) {
      this.modalData = {
        title,
        description,
        confirmAction,
        additionalData,
        loadAction,
      };
      this.isModalOpen = true;
      this.trapCleanup = focusTrap(document.querySelector("#modal"));

      console.log(additionalData);

      if (loadAction && typeof loadAction === "function") {
        loadAction(additionalData);
      }
    },

    closeModal() {
      this.isModalOpen = false;
      this.trapCleanup();
    },

    executeModalAction() {
      if (typeof this.modalData.confirmAction === "function") {
        this.isModalLoading = true;
        this.modalData.confirmAction(this.modalData.additionalData);
      }
    },

    // Modal Confirm Method
    openModalConfirm({
      title,
      description,
      confirmAction,
      additionalData = {},
    }) {
      this.modalConfirmData = {
        title,
        description,
        confirmAction,
        additionalData,
      };
      this.isModalConfirmOpen = true;
      this.trapConfirmCleanup = focusTrap(
        document.querySelector("#modal-confirm")
      );
    },

    closeModalConfirm() {
      this.isModalConfirmOpen = false;
      this.trapConfirmCleanup();
    },

    executeModalConfirmAction() {
      if (typeof this.modalConfirmData.confirmAction === "function") {
        this.isModalConfirmLoading = true;
        this.modalConfirmData.confirmAction(
          this.modalConfirmData.additionalData
        );
      }
    },
  };
}
