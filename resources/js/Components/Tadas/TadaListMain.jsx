/** @jsxImportSource @emotion/react */
import React, { Fragment } from "react";
import Tada from "@/Components/Tadas/Tada";
import { css } from "@emotion/react";
import { useTheme, Container, Typography, Stack } from "@mui/material";
import AddButton from "@/Components/AddButton";
import { Inertia } from "@inertiajs/inertia";

const tadaWidth = "500px";

export default function TadaListMain({ tadaList, tadas }) {
  const theme = useTheme();

  const addTada = (id) => {
    Inertia.post(
      route("tadas.store", id),
      {
        name: "Untitled Tada",
      },
      { replace: true }
    );
  };

  return (
    <section
      css={css`
        padding: 24px 0;
        height: calc(100vh - 56px);
        width: 100%;
        overflow-y: auto;
        background-color: ${theme.palette.mode === "light"
          ? "rgba(0,0,0,0.03)"
          : "rgba(255,255,255,0.03)"};

        ${theme.breakpoints.up("sm")} {
          height: calc(100vh - 64px);
        }

        ${theme.breakpoints.up("md")} {
          width: calc(100% - 300px);
        }
      `}
    >
      <Container>
        {tadaList && (
          <Fragment>
            <Typography
              variant="h1"
              css={css`
                margin-bottom: 30px;
              `}
            >
              {tadaList.name}
            </Typography>
            <Stack spacing={3}>
              {tadas.map((tada) => (
                <Tada
                  css={css`
                    max-width: ${tadaWidth};
                  `}
                  key={tada.id}
                  tada={tada}
                />
              ))}
              <AddButton
                css={css`
                  max-width: ${tadaWidth};
                `}
                onClick={() => addTada(tadaList.id)}
                disablePadding={true}
              />
            </Stack>
          </Fragment>
        )}
      </Container>
    </section>
  );
}
