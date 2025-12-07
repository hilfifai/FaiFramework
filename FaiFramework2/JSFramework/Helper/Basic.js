function convertWithKeys(obj) {
                      return Object.entries(obj).map(([key, value]) => {
                        // Jika value adalah object dan bukan array/null, konversi nested object
                        if (typeof value === 'object' && value !== null && !Array.isArray(value)) {
                          return [key, Object.entries(value)];
                        }
                        return [key, value];
                      });
                    }