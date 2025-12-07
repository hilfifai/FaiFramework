<style>.service-list {
          display: grid;
          grid-template-columns: 1fr;
          gap: 20px;
      }

      .service-item {
          position: relative;
          background: var(--border-gradient-onyx);
          padding: 20px;
          border-radius: 14px;
          box-shadow: var(--shadow2);
          z-index: 1;
      }

          .service-item::before {
              content: '';
              position: absolute;
              inset: 1px;
              background: var(--bg-gradient-jet);
              border-radius: inherit;
              z-index: -1;
          }

      .service-icon-box { margin-bottom: 10px; }
          .service-icon-box img { margin: auto; }

      .service-content-box { text-align: center; }
      .service-item-title { margin-bottom: 7px; }

      .service-item-text {
          color: var(--light-gray);
          font-size: var(--fs6);
          font-weight: var(--fw300);
          line-height: 1.6;
      }
          </style>