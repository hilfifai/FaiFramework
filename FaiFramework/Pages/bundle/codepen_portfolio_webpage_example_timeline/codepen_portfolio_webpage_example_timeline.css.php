<style>
    
      .timeline { margin-bottom: 30px; }

          .timeline .title-wrapper {
              display: flex;
              align-items: center;
              gap: 15px;
              margin-bottom: 25px;
          }

      .timeline-list {
          font-size: var(--fs6);
          margin-left: 45px;
      }

          .timeline-list span {
              color: var(--vegas-gold);
              font-weight: var(--fw400);
              line-height: 1.6;
          }

      .timeline-item { position: relative; }

          .timeline-item:not(:last-child) { margin-bottom: 20px; }
              .timeline-item:not(:last-child)::before {
                  content: '';
                  position: absolute;
                  top: -25px;
                  left: -30px;
                  width: 1px;
                  height: calc(100% + 50px);
                  background: var(--jet);
              }

          .timeline-item::after {
              content: '';
              position: absolute;
              top: 5px;
              left: -33px;
              height: 6px;
              width: 6px;
              border-radius: 50%;
              background: var(--text-gradient-yellow);
              box-shadow: 0 0 0 4px var(--jet);
          }

      .timeline-item-title {
          font-size: var(--fs6);
          line-height: 1.3;
          margin-bottom: 7px;
      }

      .timeline-text {
          color: var(--light-gray);
          font-weight: var(--fw300);
          line-height: 1.6;
          text-align: justify;
      }
          </style>